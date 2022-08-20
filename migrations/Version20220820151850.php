<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220820151850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Relation entre l\'entité USers et l\'entité RolesUsers';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users ADD roles_users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E94DE6C1DF FOREIGN KEY (roles_users_id) REFERENCES roles_users (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E94DE6C1DF ON users (roles_users_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E94DE6C1DF');
        $this->addSql('DROP INDEX IDX_1483A5E94DE6C1DF ON users');
        $this->addSql('ALTER TABLE users DROP roles_users_id');
    }
}
