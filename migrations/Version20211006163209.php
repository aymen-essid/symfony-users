<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211006163209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consommateur DROP roles, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE consommateur ADD CONSTRAINT FK_54A5AF52BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE producteur DROP roles, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE producteur ADD CONSTRAINT FK_7EDBEE10BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_8D93D649AEA34913 ON user');
        $this->addSql('ALTER TABLE user DROP reference');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consommateur DROP FOREIGN KEY FK_54A5AF52BF396750');
        $this->addSql('ALTER TABLE consommateur ADD roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE producteur DROP FOREIGN KEY FK_7EDBEE10BF396750');
        $this->addSql('ALTER TABLE producteur ADD roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE user ADD reference VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AEA34913 ON user (reference)');
    }
}
