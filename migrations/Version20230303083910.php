<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230303083910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD cate_Id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66E8B42C47 FOREIGN KEY (cate_Id) REFERENCES category (catid)');
        $this->addSql('CREATE INDEX IDX_23A0E66E8B42C47 ON article (cate_Id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66E8B42C47');
        $this->addSql('DROP INDEX IDX_23A0E66E8B42C47 ON article');
        $this->addSql('ALTER TABLE article DROP cate_Id');
    }
}
