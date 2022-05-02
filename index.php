<?php
    $users = [];

    class User {
        protected int $id;
        protected float $discount_factor = 1;
        protected array $cart = [];

        public function __construct(){
            $this->id = time();
        }

        protected function addToCart(object $article){
            $this->cart[] = $article;
        }
    }

    class RegisteredUser extends User {
        private $email;
        private $password;

        public function __construct(string $email, string $password){
            parent::__construct();
            $this->email = $email;
            $this->password = $password;
            $this->discount_factor = .8;
        }
    }

    class Goods {
        protected int $id;
        protected int $price_cents;
        protected string $name;
        protected string $img_url;
        protected string $description;
        protected $availability_start;
        protected $availability_end;

        public function __construct(string $name, int $price_cents, string $img_url, string $availability_start = null, string $availability_end = null){
            $this->id = time();
            $this->name = $name;
            $this->price_cents = $price_cents;
            $this->img_url = $img_url;
            if ($availability_start != null) {
                $this->availability_start = strtotime($availability_start);
            }
            if ($availability_end != null){
                $this->availability_end = strtotime($availability_end);
            }
        }

    }

    


    $user = new RegisteredUser('gigigigig', 12345);
    $user2 = new user;

    $item = new Goods ('gioco', 12589, './giochi');

    var_dump($user2);

    var_dump($user);
    var_dump($item);