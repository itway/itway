<?php

namespace Itway\Commands;

use itway\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use itway\Events\PostWasUpdatedEvent;

class UpdatePostCommand extends Command implements SelfHandling
{

      public $post;
      public $data;


      /**constructor**/
      public function __construct(
              $post,
  			      $data)
  	           {
              $this->post = $post;
  			      $this->data = $data;
              	}

      /**
       * @return \Illuminate\Database\Eloquent\Model
       */
      public function handle()

      {

          $this->post->update(
            $this->data
          );

          event(new PostWasUpdatedEvent($post, Auth::user()));

          return $post;
      }

}
