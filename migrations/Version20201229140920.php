<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201229140920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE day ADD tour_id INT NOT NULL');
        $this->addSql('ALTER TABLE day ADD CONSTRAINT FK_E5A0299015ED8D43 FOREIGN KEY (tour_id) REFERENCES tour (id)');
        $this->addSql('CREATE INDEX IDX_E5A0299015ED8D43 ON day (tour_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE day DROP FOREIGN KEY FK_E5A0299015ED8D43');
        $this->addSql('DROP INDEX IDX_E5A0299015ED8D43 ON day');
        $this->addSql('ALTER TABLE day DROP tour_id');
    }
}
