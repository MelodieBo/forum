<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Thread;
use App\Entity\Message;

class ForumFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = \Faker\Factory::create('fr_FR');
        for($i=0;$i<mt_rand(10,15);$i++) {
            $thread = new Thread();
            $thread->setSubject($faker->word);
            $thread->setCreatedAt($faker->dateTime());
            $thread->setAuthor($faker->name());
            $thread->setEmail($faker->email());
            $thread->setText($faker->realText());
            $manager->persist($thread);

            for($j=1;$j<=\mt_rand(20, 40);$j++) {
                $message = new Message();
                $message->setThread($thread);
                $message->setSubject($faker->word);
                $message->setCreatedAt($faker->dateTime());
                $message->setAuthor($faker->name());
                $message->setEmail($faker->email);
                $message->setText($faker->realText());
                $manager->persist($message);
            }
        }

        $manager->flush();
    }
}
