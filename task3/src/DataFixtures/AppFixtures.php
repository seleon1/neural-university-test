<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Order;
use App\Entity\Manager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $managerEntity = new Manager();
            $managerEntity->setFirstName('Manager'.$i);
            $managerEntity->setLastName('Lastname'.$i);
            $managerEntity->setBirthdate(new \DateTimeImmutable('1990-01-01'));

            $managerReference = 'manager_'.$i;
            $this->addReference($managerReference, $managerEntity);

            $manager->persist($managerEntity);
        }

        // Создаем 50 заказов и связываем их с менеджерами
        for ($i = 1; $i <= 50; $i++) {
            $orderEntity = new Order();
            $orderEntity->setName('Order'.$i);

            // Выбираем случайного менеджера
            $randomManagerIndex = mt_rand(1, 10);
            $randomManagerReference = 'manager_'.$randomManagerIndex;
            $randomManager = $this->getReference($randomManagerReference);
            $orderEntity->setManager($randomManager);

            $manager->persist($orderEntity);
        }

        $manager->flush();
    }
}
