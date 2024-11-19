<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119104344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3BE8E8ED5');
        $this->addSql('CREATE TABLE project_column (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_6AF76C34166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_column ADD CONSTRAINT FK_6AF76C34166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE `column` DROP FOREIGN KEY FK_7D53877E166D1F9C');
        $this->addSql('DROP TABLE `column`');
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3BE8E8ED5');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3BE8E8ED5 FOREIGN KEY (column_id) REFERENCES project_column (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3BE8E8ED5');
        $this->addSql('CREATE TABLE `column` (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_7D53877E166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `column` ADD CONSTRAINT FK_7D53877E166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE project_column DROP FOREIGN KEY FK_6AF76C34166D1F9C');
        $this->addSql('DROP TABLE project_column');
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3BE8E8ED5');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3BE8E8ED5 FOREIGN KEY (column_id) REFERENCES `column` (id)');
    }
}
