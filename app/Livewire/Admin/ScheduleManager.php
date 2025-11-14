<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Doctor;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Carbon\CarbonPeriod;

class ScheduleManager extends Component
{
    public Doctor $doctor;
    public $schedule = [];

    public $days = [];

    public $apointment_duration;
    public $startTime;
    public $endTime;
    public $intervals;

    #[Computed()]
    public function hourBlocks()
    {
        return CarbonPeriod::create(
            Carbon::createFromTimeString($this->startTime),
            '1 hour',
            Carbon::createFromTimeString($this->endTime)
        )->excludeEndDate();
    }

    public function mount(Doctor $doctor)
    {
        $this->days = config('schedule.days');
        $this->apointment_duration = config('schedule.apointment_duration');
        $this->startTime = config('schedule.start_time');
        $this->endTime = config('schedule.end_time');


        $this->intervals = 60 / $this->apointment_duration;
        $this->initializeSchedule();
    }

    public function initializeSchedule()
    {
        $schedules = $this->doctor->schedules;

        foreach ($this->hourBlocks as $hourBlock ) {
            $period = CarbonPeriod::create(
                $hourBlock->copy(),
                $this->apointment_duration . ' minutes',
                $hourBlock->copy()->addHour()
            );

            foreach ($period as $time) {

                foreach ($this->days as $index => $day ) {

                    $this->schedule[$index][$time->format('H:i:s')] = $schedules->contains(function( $schedule ) use ( $index, $time ) {
                        return $schedule->day_of_week == $index && $schedule->start_time->format('H:i:s') == $time->format('H:i:s');
                    });
                }
            }
        }
    }

    public function save()
    {
        $this->doctor->schedules()->delete();

        foreach ($this->schedule as $dayOfWeek => $intervals) {
            foreach ($intervals as $startTime => $isChecked ) {
                if ($isChecked) {
                    $this->doctor->schedules()->create([
                        'day_of_week' => $dayOfWeek,
                        'start_time' => $startTime,
                    ]);
                }
            }
        }

        $this->dispatch('swal',[
            'title' => 'Horario actualizado',
            'text' =>  'Horaio de '.$this->doctor->user->name.' actualizado correctamente.',
            'icon' => 'success',
        ]);

    }


    public function render()
    {
        return view('livewire.admin.schedule-manager');
    }
}
