<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220110132718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE stage_entreprise');
        $this->addSql('DROP TABLE stage_formation');
        $this->addSql('ALTER TABLE stage ADD formation_stage_id INT DEFAULT NULL, ADD entreprise_stage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369E50A8662 FOREIGN KEY (formation_stage_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C93697048D716 FOREIGN KEY (entreprise_stage_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_C27C9369E50A8662 ON stage (formation_stage_id)');
        $this->addSql('CREATE INDEX IDX_C27C93697048D716 ON stage (entreprise_stage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stage_entreprise (stage_id INT NOT NULL, entreprise_id INT NOT NULL, INDEX IDX_4143E1C4A4AEAFEA (entreprise_id), INDEX IDX_4143E1C42298D193 (stage_id), PRIMARY KEY(stage_id, entreprise_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE stage_formation (stage_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_734BDB9E5200282E (formation_id), INDEX IDX_734BDB9E2298D193 (stage_id), PRIMARY KEY(stage_id, formation_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE stage_entreprise ADD CONSTRAINT FK_4143E1C42298D193 FOREIGN KEY (stage_id) REFERENCES stage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stage_entreprise ADD CONSTRAINT FK_4143E1C4A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stage_formation ADD CONSTRAINT FK_734BDB9E2298D193 FOREIGN KEY (stage_id) REFERENCES stage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stage_formation ADD CONSTRAINT FK_734BDB9E5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C9369E50A8662');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C93697048D716');
        $this->addSql('DROP INDEX IDX_C27C9369E50A8662 ON stage');
        $this->addSql('DROP INDEX IDX_C27C93697048D716 ON stage');
        $this->addSql('ALTER TABLE stage DROP formation_stage_id, DROP entreprise_stage_id');
    }
}
