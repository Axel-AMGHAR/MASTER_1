<?php

namespace App\DataFixtures;

use App\Entity\Booking;
use App\Entity\Customer;
use App\Entity\Option;
use App\Entity\Room;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BookingFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $faker->seed(0);
        /* option
         *2 option : petit dej /lit supp
         *room ( 10)
         * customer (50)
         * booking (10/30 par chambre)
         *  */

        /** OPTIONS */
        $option_breackfast = new Option();
        $option_breackfast
            ->setName('Petit déjeuner')
            ->setPrice(7.5);
        $manager->persist($option_breackfast);

        $option_jacuzzi = new Option();
        $option_jacuzzi
            ->setName('Jacuzzi')
            ->setPrice(40.99);
        $manager->persist($option_breackfast);

        $option_television = new Option();
        $option_television
            ->setName('television')
            ->setPrice(5.5);
        $manager->persist($option_television);

        $manager->flush();

        /** ROOMS */
        $rooms = [];
        for($i=0;$i<10;$i++){
            $room = new Room();
            $room
                ->setName('Chambre '.$i)
                ->setNumber($i+1)
                ->setPrice($faker->randomFloat(2,50,150))
                ->addOption($option_television)->addOption($option_jacuzzi);

            if($i % 3 === 0 ){
                $room->addOption($option_breackfast);
            }
            $manager->persist($room);
            $rooms[] = $room;
        }
        $manager->flush();

        /** CUSTOMERS */
        $customers = [];
        for($i=0;$i<50;$i++){
            $customer = new Customer();
            $customer
                ->setEmail($faker->safeEmail)
                ->setLastname($faker->lastName)
                ->setFirstname($faker->firstName($i % 2 === 0 ? 'male' : 'female'));
            $manager->persist($customer);
            $customers[] = $customer;
        }
        $manager->flush();

        /** BOOKINGS */
        $number_customer = count($customers) - 1;
        foreach ($rooms as $room){
            $number_booking = $faker->numberBetween(10,30);

            for($i=0; $i<$number_booking;$i++){
                $start_date = $faker->dateTimeBetween('-6 month','+6 month', 'Europe/Paris');
                $start_date->setTime(0,0,0,0);
                $number_night = $faker->numberBetween(1, 10);
                $end_date = (clone $start_date)->modify("+$number_night days");

                $booking = new Booking();
                $booking
                    ->setCreatedAt(new DateTime('now', new \DateTimeZone('Europe/Paris')))
                    ->setStartDate($start_date)
                    ->setEndDate($end_date)
                    ->setRoom($room)
                    ->setCustomer($customers[$faker->numberBetween(0,$number_customer)])
                    ->setComment($faker->sentence);
                $manager->persist($booking);
            }
            $manager->flush();
        }
        $manager->flush();
    }
}
