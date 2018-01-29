<?php
    namespace App;
    use Illuminate\Support\Collection;

    class MyCollection extends Collection {

        public function __construct($items = []) {
            parent::__construct($items);
        }

        /**
        * Partition the collection into two arrays using the given callback or key.
        *
        * @param  callable|string  $callback
        * @return static
        */
        public function partition($callback)
        {
            $partitions = [new static, new static];

            $callback = $this->valueRetriever($callback);

            foreach ($this->items as $key => $item) {
                $partitions[(int) ! $callback($item,$key)][$key] = $item;
            }

            return new static($partitions);
        }
    }
?>