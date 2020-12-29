<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201229122716 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE day (id INT AUTO_INCREMENT NOT NULL, destination_id INT NOT NULL, amenity_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_E5A02990816C6140 (destination_id), INDEX IDX_E5A029909F9F1305 (amenity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tour (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE day ADD CONSTRAINT FK_E5A02990816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id)');
        $this->addSql('ALTER TABLE day ADD CONSTRAINT FK_E5A029909F9F1305 FOREIGN KEY (amenity_id) REFERENCES amenity (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE day');
        $this->addSql('DROP TABLE tour');
    }
}
