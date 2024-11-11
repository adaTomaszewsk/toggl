<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241111204243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assignee (id INT AUTO_INCREMENT NOT NULL, card_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7C9DFC0C4ACC9A20 (card_id), INDEX IDX_7C9DFC0CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE card (id INT AUTO_INCREMENT NOT NULL, column_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_161498D3BE8E8ED5 (column_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE card_assignee (card_id INT NOT NULL, assignee_id INT NOT NULL, INDEX IDX_C5AC328F4ACC9A20 (card_id), INDEX IDX_C5AC328F59EC7D60 (assignee_id), PRIMARY KEY(card_id, assignee_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE card_history (id INT AUTO_INCREMENT NOT NULL, card_id INT NOT NULL, performed_by_id INT DEFAULT NULL, action VARCHAR(255) NOT NULL, timestamp DATETIME NOT NULL, INDEX IDX_70A0FA3D4ACC9A20 (card_id), INDEX IDX_70A0FA3D2E65C292 (performed_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `column` (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_7D53877E166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, card_id INT NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_9474526C4ACC9A20 (card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment_user (comment_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_ABA574A5F8697D13 (comment_id), INDEX IDX_ABA574A5A76ED395 (user_id), PRIMARY KEY(comment_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_2FB3D0EEB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assignee ADD CONSTRAINT FK_7C9DFC0C4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id)');
        $this->addSql('ALTER TABLE assignee ADD CONSTRAINT FK_7C9DFC0CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3BE8E8ED5 FOREIGN KEY (column_id) REFERENCES `column` (id)');
        $this->addSql('ALTER TABLE card_assignee ADD CONSTRAINT FK_C5AC328F4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE card_assignee ADD CONSTRAINT FK_C5AC328F59EC7D60 FOREIGN KEY (assignee_id) REFERENCES assignee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE card_history ADD CONSTRAINT FK_70A0FA3D4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id)');
        $this->addSql('ALTER TABLE card_history ADD CONSTRAINT FK_70A0FA3D2E65C292 FOREIGN KEY (performed_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `column` ADD CONSTRAINT FK_7D53877E166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id)');
        $this->addSql('ALTER TABLE comment_user ADD CONSTRAINT FK_ABA574A5F8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_user ADD CONSTRAINT FK_ABA574A5A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEB03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assignee DROP FOREIGN KEY FK_7C9DFC0C4ACC9A20');
        $this->addSql('ALTER TABLE assignee DROP FOREIGN KEY FK_7C9DFC0CA76ED395');
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3BE8E8ED5');
        $this->addSql('ALTER TABLE card_assignee DROP FOREIGN KEY FK_C5AC328F4ACC9A20');
        $this->addSql('ALTER TABLE card_assignee DROP FOREIGN KEY FK_C5AC328F59EC7D60');
        $this->addSql('ALTER TABLE card_history DROP FOREIGN KEY FK_70A0FA3D4ACC9A20');
        $this->addSql('ALTER TABLE card_history DROP FOREIGN KEY FK_70A0FA3D2E65C292');
        $this->addSql('ALTER TABLE `column` DROP FOREIGN KEY FK_7D53877E166D1F9C');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4ACC9A20');
        $this->addSql('ALTER TABLE comment_user DROP FOREIGN KEY FK_ABA574A5F8697D13');
        $this->addSql('ALTER TABLE comment_user DROP FOREIGN KEY FK_ABA574A5A76ED395');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEB03A8386');
        $this->addSql('DROP TABLE assignee');
        $this->addSql('DROP TABLE card');
        $this->addSql('DROP TABLE card_assignee');
        $this->addSql('DROP TABLE card_history');
        $this->addSql('DROP TABLE `column`');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE comment_user');
        $this->addSql('DROP TABLE project');
    }
}
