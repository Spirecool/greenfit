<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220821125625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'RELATION entre partenaires et modules';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partners_modules (partners_id INT NOT NULL, modules_id INT NOT NULL, INDEX IDX_5DFB55A7BDE7F1C6 (partners_id), INDEX IDX_5DFB55A760D6DC42 (modules_id), PRIMARY KEY(partners_id, modules_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partners_modules ADD CONSTRAINT FK_5DFB55A7BDE7F1C6 FOREIGN KEY (partners_id) REFERENCES partners (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partners_modules ADD CONSTRAINT FK_5DFB55A760D6DC42 FOREIGN KEY (modules_id) REFERENCES modules (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partners_modules DROP FOREIGN KEY FK_5DFB55A7BDE7F1C6');
        $this->addSql('ALTER TABLE partners_modules DROP FOREIGN KEY FK_5DFB55A760D6DC42');
        $this->addSql('DROP TABLE partners_modules');
    }
}
