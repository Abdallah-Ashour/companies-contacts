<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'descripation' => $this->faker->text(),
        ];
    }

    public function compeleted(){
          return $this->state(function(array $attribute){
            return [
                 'status' => true
            ];
          });
    }

    public function uncompeleted(){
        return $this->state(function(array $attribute){
          return [
               'status' => false
          ];
        });
  }
  public function tomorrow(){
    return $this->state(function(array $attribute){
        return [
              'due_date' => now()->addDay()
        ];
    });
  }

  public function priority($level = 1){
    return $this->state(function(array $attribute) use($level){
        return [
            'priority' => $level
        ];
    });
  }

}// end of class
