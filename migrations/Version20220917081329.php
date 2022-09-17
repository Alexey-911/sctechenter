<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220917081329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE message (id UUID NOT NULL, from_user_id UUID DEFAULT NULL, to_user_id UUID DEFAULT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6BD307F2130303A ON message (from_user_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F29F6EE60 ON message (to_user_id)');
        $this->addSql('CREATE INDEX users_idx ON message (to_user_id, from_user_id)');
        $this->addSql('COMMENT ON COLUMN message.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN message.from_user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN message.to_user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F2130303A FOREIGN KEY (from_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F29F6EE60 FOREIGN KEY (to_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT FK_B6BD307F2130303A');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT FK_B6BD307F29F6EE60');
        $this->addSql('DROP TABLE message');
    }
}
