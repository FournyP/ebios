<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210625142625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE action (id INT AUTO_INCREMENT NOT NULL, column_action_id INT NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_47CC8C926C0CCC4B (column_action_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE action_action (action_source INT NOT NULL, action_target INT NOT NULL, INDEX IDX_85FCBDF99DBA4E18 (action_source), INDEX IDX_85FCBDF9845F1E97 (action_target), PRIMARY KEY(action_source, action_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE business_asset (id INT AUTO_INCREMENT NOT NULL, workshop1_id INT NOT NULL, name VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, manager VARCHAR(255) NOT NULL, INDEX IDX_7C4EBDE38FC0CC61 (workshop1_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE column_action (id INT AUTO_INCREMENT NOT NULL, operational_scenario_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_E7FB295D3709DEFF (operational_scenario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feared_event (id INT AUTO_INCREMENT NOT NULL, business_asset_id INT NOT NULL, description LONGTEXT NOT NULL, impact LONGTEXT NOT NULL, severity SMALLINT NOT NULL, INDEX IDX_9AEF3051DEA17D7 (business_asset_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gap (id INT AUTO_INCREMENT NOT NULL, security_baseline_id INT NOT NULL, description LONGTEXT NOT NULL, justification LONGTEXT NOT NULL, INDEX IDX_9E3A2F6DFC875DC9 (security_baseline_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE measure (id INT AUTO_INCREMENT NOT NULL, workshop5_id INT NOT NULL, label VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, deadline VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\', status VARCHAR(255) NOT NULL, complexity SMALLINT NOT NULL, difficulty VARCHAR(255) NOT NULL, manager VARCHAR(255) NOT NULL, INDEX IDX_80071925A25B36 (workshop5_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE measure_operational_scenario (measure_id INT NOT NULL, operational_scenario_id INT NOT NULL, INDEX IDX_B1531D8A5DA37D00 (measure_id), INDEX IDX_B1531D8A3709DEFF (operational_scenario_id), PRIMARY KEY(measure_id, operational_scenario_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operational_scenario (id INT AUTO_INCREMENT NOT NULL, strategic_scenario_id INT NOT NULL, workshop4_id INT NOT NULL, overall_likelihood SMALLINT NOT NULL, UNIQUE INDEX UNIQ_EA561A594E145CD9 (strategic_scenario_id), INDEX IDX_EA561A59B81E3C53 (workshop4_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organization (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organization_user (organization_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B49AE8D432C8A3DE (organization_id), INDEX IDX_B49AE8D4A76ED395 (user_id), PRIMARY KEY(organization_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, organization_id INT NOT NULL, project_parameters_id INT DEFAULT NULL, workshop1_id INT DEFAULT NULL, workshop2_id INT DEFAULT NULL, workshop3_id INT DEFAULT NULL, workshop4_id INT DEFAULT NULL, workshop5_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_2FB3D0EE32C8A3DE (organization_id), UNIQUE INDEX UNIQ_2FB3D0EE5C2C0B19 (project_parameters_id), UNIQUE INDEX UNIQ_2FB3D0EE8FC0CC61 (workshop1_id), UNIQUE INDEX UNIQ_2FB3D0EE9D75638F (workshop2_id), UNIQUE INDEX UNIQ_2FB3D0EE25C904EA (workshop3_id), UNIQUE INDEX UNIQ_2FB3D0EEB81E3C53 (workshop4_id), UNIQUE INDEX UNIQ_2FB3D0EEA25B36 (workshop5_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_parameters (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, workshops_defined JSON NOT NULL, UNIQUE INDEX UNIQ_1E3533CC166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE risk (id INT AUTO_INCREMENT NOT NULL, workshop2_id INT NOT NULL, source VARCHAR(255) NOT NULL, goal VARCHAR(255) NOT NULL, evaluation JSON NOT NULL, INDEX IDX_7906D5419D75638F (workshop2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE security_baseline (id INT AUTO_INCREMENT NOT NULL, workshop1_id INT NOT NULL, reference_standard_type VARCHAR(255) NOT NULL, reference_standard_name VARCHAR(255) NOT NULL, implementation_status VARCHAR(255) NOT NULL, INDEX IDX_957254948FC0CC61 (workshop1_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE security_measure (id INT AUTO_INCREMENT NOT NULL, stake_holder_id INT NOT NULL, strategic_attack_path VARCHAR(255) NOT NULL, measure LONGTEXT NOT NULL, initial_threat SMALLINT NOT NULL, residual_threat SMALLINT NOT NULL, INDEX IDX_EDEC1238E8EFD570 (stake_holder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stake_holder (id INT AUTO_INCREMENT NOT NULL, stake_holder_category_id INT NOT NULL, name VARCHAR(255) NOT NULL, exposure SMALLINT NOT NULL, cyber_reliability SMALLINT NOT NULL, selected TINYINT(1) NOT NULL, INDEX IDX_AC153AB2DDFCC0AB (stake_holder_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stake_holder_category (id INT AUTO_INCREMENT NOT NULL, workshop3_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_12B99F325C904EA (workshop3_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE strategic_scenario (id INT AUTO_INCREMENT NOT NULL, risk_id INT NOT NULL, workshop3_id INT NOT NULL, operational_scenario_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, strategy LONGTEXT NOT NULL, severity SMALLINT NOT NULL, INDEX IDX_AB5A39E6235B6D1 (risk_id), INDEX IDX_AB5A39E625C904EA (workshop3_id), UNIQUE INDEX UNIQ_AB5A39E63709DEFF (operational_scenario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supporting_asset (id INT AUTO_INCREMENT NOT NULL, business_asset_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, manager VARCHAR(255) NOT NULL, INDEX IDX_3E9A3A8FDEA17D7 (business_asset_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workshop1 (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, workshop_contributors JSON NOT NULL, UNIQUE INDEX UNIQ_1F4E861C166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workshop2 (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, evaluation_base JSON NOT NULL, UNIQUE INDEX UNIQ_8647D7A6166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workshop3 (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, UNIQUE INDEX UNIQ_F140E730166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workshop4 (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, UNIQUE INDEX UNIQ_6F247293166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workshop5 (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, UNIQUE INDEX UNIQ_18234205166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C926C0CCC4B FOREIGN KEY (column_action_id) REFERENCES column_action (id)');
        $this->addSql('ALTER TABLE action_action ADD CONSTRAINT FK_85FCBDF99DBA4E18 FOREIGN KEY (action_source) REFERENCES action (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE action_action ADD CONSTRAINT FK_85FCBDF9845F1E97 FOREIGN KEY (action_target) REFERENCES action (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE business_asset ADD CONSTRAINT FK_7C4EBDE38FC0CC61 FOREIGN KEY (workshop1_id) REFERENCES workshop1 (id)');
        $this->addSql('ALTER TABLE column_action ADD CONSTRAINT FK_E7FB295D3709DEFF FOREIGN KEY (operational_scenario_id) REFERENCES operational_scenario (id)');
        $this->addSql('ALTER TABLE feared_event ADD CONSTRAINT FK_9AEF3051DEA17D7 FOREIGN KEY (business_asset_id) REFERENCES business_asset (id)');
        $this->addSql('ALTER TABLE gap ADD CONSTRAINT FK_9E3A2F6DFC875DC9 FOREIGN KEY (security_baseline_id) REFERENCES security_baseline (id)');
        $this->addSql('ALTER TABLE measure ADD CONSTRAINT FK_80071925A25B36 FOREIGN KEY (workshop5_id) REFERENCES workshop5 (id)');
        $this->addSql('ALTER TABLE measure_operational_scenario ADD CONSTRAINT FK_B1531D8A5DA37D00 FOREIGN KEY (measure_id) REFERENCES measure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE measure_operational_scenario ADD CONSTRAINT FK_B1531D8A3709DEFF FOREIGN KEY (operational_scenario_id) REFERENCES operational_scenario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE operational_scenario ADD CONSTRAINT FK_EA561A594E145CD9 FOREIGN KEY (strategic_scenario_id) REFERENCES strategic_scenario (id)');
        $this->addSql('ALTER TABLE operational_scenario ADD CONSTRAINT FK_EA561A59B81E3C53 FOREIGN KEY (workshop4_id) REFERENCES workshop4 (id)');
        $this->addSql('ALTER TABLE organization_user ADD CONSTRAINT FK_B49AE8D432C8A3DE FOREIGN KEY (organization_id) REFERENCES organization (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE organization_user ADD CONSTRAINT FK_B49AE8D4A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE32C8A3DE FOREIGN KEY (organization_id) REFERENCES organization (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE5C2C0B19 FOREIGN KEY (project_parameters_id) REFERENCES project_parameters (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE8FC0CC61 FOREIGN KEY (workshop1_id) REFERENCES workshop1 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE9D75638F FOREIGN KEY (workshop2_id) REFERENCES workshop2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE25C904EA FOREIGN KEY (workshop3_id) REFERENCES workshop3 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEB81E3C53 FOREIGN KEY (workshop4_id) REFERENCES workshop4 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEA25B36 FOREIGN KEY (workshop5_id) REFERENCES workshop5 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_parameters ADD CONSTRAINT FK_1E3533CC166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE risk ADD CONSTRAINT FK_7906D5419D75638F FOREIGN KEY (workshop2_id) REFERENCES workshop2 (id)');
        $this->addSql('ALTER TABLE security_baseline ADD CONSTRAINT FK_957254948FC0CC61 FOREIGN KEY (workshop1_id) REFERENCES workshop1 (id)');
        $this->addSql('ALTER TABLE security_measure ADD CONSTRAINT FK_EDEC1238E8EFD570 FOREIGN KEY (stake_holder_id) REFERENCES stake_holder (id)');
        $this->addSql('ALTER TABLE stake_holder ADD CONSTRAINT FK_AC153AB2DDFCC0AB FOREIGN KEY (stake_holder_category_id) REFERENCES stake_holder_category (id)');
        $this->addSql('ALTER TABLE stake_holder_category ADD CONSTRAINT FK_12B99F325C904EA FOREIGN KEY (workshop3_id) REFERENCES workshop3 (id)');
        $this->addSql('ALTER TABLE strategic_scenario ADD CONSTRAINT FK_AB5A39E6235B6D1 FOREIGN KEY (risk_id) REFERENCES risk (id)');
        $this->addSql('ALTER TABLE strategic_scenario ADD CONSTRAINT FK_AB5A39E625C904EA FOREIGN KEY (workshop3_id) REFERENCES workshop3 (id)');
        $this->addSql('ALTER TABLE strategic_scenario ADD CONSTRAINT FK_AB5A39E63709DEFF FOREIGN KEY (operational_scenario_id) REFERENCES operational_scenario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE supporting_asset ADD CONSTRAINT FK_3E9A3A8FDEA17D7 FOREIGN KEY (business_asset_id) REFERENCES business_asset (id)');
        $this->addSql('ALTER TABLE workshop1 ADD CONSTRAINT FK_1F4E861C166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE workshop2 ADD CONSTRAINT FK_8647D7A6166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE workshop3 ADD CONSTRAINT FK_F140E730166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE workshop4 ADD CONSTRAINT FK_6F247293166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE workshop5 ADD CONSTRAINT FK_18234205166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE action_action DROP FOREIGN KEY FK_85FCBDF99DBA4E18');
        $this->addSql('ALTER TABLE action_action DROP FOREIGN KEY FK_85FCBDF9845F1E97');
        $this->addSql('ALTER TABLE feared_event DROP FOREIGN KEY FK_9AEF3051DEA17D7');
        $this->addSql('ALTER TABLE supporting_asset DROP FOREIGN KEY FK_3E9A3A8FDEA17D7');
        $this->addSql('ALTER TABLE action DROP FOREIGN KEY FK_47CC8C926C0CCC4B');
        $this->addSql('ALTER TABLE measure_operational_scenario DROP FOREIGN KEY FK_B1531D8A5DA37D00');
        $this->addSql('ALTER TABLE column_action DROP FOREIGN KEY FK_E7FB295D3709DEFF');
        $this->addSql('ALTER TABLE measure_operational_scenario DROP FOREIGN KEY FK_B1531D8A3709DEFF');
        $this->addSql('ALTER TABLE strategic_scenario DROP FOREIGN KEY FK_AB5A39E63709DEFF');
        $this->addSql('ALTER TABLE organization_user DROP FOREIGN KEY FK_B49AE8D432C8A3DE');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE32C8A3DE');
        $this->addSql('ALTER TABLE project_parameters DROP FOREIGN KEY FK_1E3533CC166D1F9C');
        $this->addSql('ALTER TABLE workshop1 DROP FOREIGN KEY FK_1F4E861C166D1F9C');
        $this->addSql('ALTER TABLE workshop2 DROP FOREIGN KEY FK_8647D7A6166D1F9C');
        $this->addSql('ALTER TABLE workshop3 DROP FOREIGN KEY FK_F140E730166D1F9C');
        $this->addSql('ALTER TABLE workshop4 DROP FOREIGN KEY FK_6F247293166D1F9C');
        $this->addSql('ALTER TABLE workshop5 DROP FOREIGN KEY FK_18234205166D1F9C');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE5C2C0B19');
        $this->addSql('ALTER TABLE strategic_scenario DROP FOREIGN KEY FK_AB5A39E6235B6D1');
        $this->addSql('ALTER TABLE gap DROP FOREIGN KEY FK_9E3A2F6DFC875DC9');
        $this->addSql('ALTER TABLE security_measure DROP FOREIGN KEY FK_EDEC1238E8EFD570');
        $this->addSql('ALTER TABLE stake_holder DROP FOREIGN KEY FK_AC153AB2DDFCC0AB');
        $this->addSql('ALTER TABLE operational_scenario DROP FOREIGN KEY FK_EA561A594E145CD9');
        $this->addSql('ALTER TABLE organization_user DROP FOREIGN KEY FK_B49AE8D4A76ED395');
        $this->addSql('ALTER TABLE business_asset DROP FOREIGN KEY FK_7C4EBDE38FC0CC61');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE8FC0CC61');
        $this->addSql('ALTER TABLE security_baseline DROP FOREIGN KEY FK_957254948FC0CC61');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE9D75638F');
        $this->addSql('ALTER TABLE risk DROP FOREIGN KEY FK_7906D5419D75638F');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE25C904EA');
        $this->addSql('ALTER TABLE stake_holder_category DROP FOREIGN KEY FK_12B99F325C904EA');
        $this->addSql('ALTER TABLE strategic_scenario DROP FOREIGN KEY FK_AB5A39E625C904EA');
        $this->addSql('ALTER TABLE operational_scenario DROP FOREIGN KEY FK_EA561A59B81E3C53');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEB81E3C53');
        $this->addSql('ALTER TABLE measure DROP FOREIGN KEY FK_80071925A25B36');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEA25B36');
        $this->addSql('DROP TABLE action');
        $this->addSql('DROP TABLE action_action');
        $this->addSql('DROP TABLE business_asset');
        $this->addSql('DROP TABLE column_action');
        $this->addSql('DROP TABLE feared_event');
        $this->addSql('DROP TABLE gap');
        $this->addSql('DROP TABLE measure');
        $this->addSql('DROP TABLE measure_operational_scenario');
        $this->addSql('DROP TABLE operational_scenario');
        $this->addSql('DROP TABLE organization');
        $this->addSql('DROP TABLE organization_user');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_parameters');
        $this->addSql('DROP TABLE risk');
        $this->addSql('DROP TABLE security_baseline');
        $this->addSql('DROP TABLE security_measure');
        $this->addSql('DROP TABLE stake_holder');
        $this->addSql('DROP TABLE stake_holder_category');
        $this->addSql('DROP TABLE strategic_scenario');
        $this->addSql('DROP TABLE supporting_asset');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE workshop1');
        $this->addSql('DROP TABLE workshop2');
        $this->addSql('DROP TABLE workshop3');
        $this->addSql('DROP TABLE workshop4');
        $this->addSql('DROP TABLE workshop5');
    }
}
