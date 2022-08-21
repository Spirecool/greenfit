<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220821125052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'CREATION de l\'entité Modules';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE modules DROP is_statistic, DROP is_newsletter, DROP is_planning, DROP is_drinks, CHANGE is_default is_default TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE partners DROP is_sms');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE modules ADD is_statistic TINYINT(1) NOT NULL, ADD is_newsletter TINYINT(1) NOT NULL, ADD is_planning TINYINT(1) NOT NULL, ADD is_drinks TINYINT(1) NOT NULL, CHANGE is_default is_default TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE partners ADD is_sms TINYINT(1) NOT NULL');
    }
}
