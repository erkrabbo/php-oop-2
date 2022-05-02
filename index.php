<?php
    $users = [];

    class User {
        protected int $id;
        protected float $discount_factor = 1;
        protected array $cart = [];
        protected $card_expire_date = null;

        public function __construct(){
            $this->id = time();
        }

        public function addToCart(object $article){
            $this->cart[] = $article;
        }

        public function addCardDate(string $date){
            $new_card_date = strtotime($date);
            $difference = $new_card_date - time();
            if ($new_card_date && ($difference > 0)){
                $this-> card_expire_date = $date;
            }
        }
        
        public function cartTotal(){
            $total = 0;
            foreach($this->cart as $item){
                $total += $item->getPrice();
            }

            return $total * $this->discount_factor;
        }

        public function validateCard() {
            return $this->card_expire_date !=null ? true : false;
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
        protected $available_now = true;

        public function __construct(string $name, int $price_cents, string $img_url = null, string $availability_start = null, string $availability_end = null){
            $this->id = time();
            $this->name = $name;
            $this->price_cents = $price_cents;
            $this->img_url = $img_url;

            if ($availability_start != null && strtotime($availability_start)) {
                $start = strtotime($availability_start);
                $this->availability_start = date("Y-m-d", $start);

            }

            if ($availability_end != null && strtotime($availability_end)) {
                $end = strtotime($availability_end);
                $this->availability_end = date("Y-m-d", $end);
            }

            $this->check_availability();
        }

        public function check_availability(){
            if ($this->availability_start != null || $this->availability_end != null) {
                if (!(time() - strtotime($this->availability_start) > 0 && time() - strtotime($this->availability_end) < 0))
                $this->available_now = false;
            }
        }

        public function getPrice(){
            return $this->price_cents / 100;
        }

    }

    


    $user = new RegisteredUser('gianni', 12345);
    $user2 = new user;

    $item = new Goods ('gioco', 12589, './giochi', "01-01-2022", "02-02-2022");

    
    var_dump($user);
    var_dump($user2);
    var_dump($item);