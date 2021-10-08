<?php

declare(strict_types=1);

namespace App\migrations;


use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210805184542 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }


    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE tasks_two (id INT AUTO_INCREMENT NOT NULL,
                        task VARCHAR(255) NOT NULL,
                        complete TINYINT(1) DEFAULT FALSE,
                        priority INT NOT NULL, 
                        created_at TIMESTAMP DEFAULT current_timestamp,
                        PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
