<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240418163001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE certificat');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY event_ibfk_1');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7751CD951');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7BD280927');
        $this->addSql('DROP INDEX paniers ON event');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7751CD951');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7BD280927');
        $this->addSql('ALTER TABLE event DROP paniers');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7751CD951 FOREIGN KEY (idEstab) REFERENCES etablissement (ID_Etablissement)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7BD280927 FOREIGN KEY (idPartnerCE) REFERENCES partner (idPartner)');
        $this->addSql('DROP INDEX idestab ON event');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7751CD951 ON event (idEstab)');
        $this->addSql('DROP INDEX fk_partner ON event');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7BD280927 ON event (idPartnerCE)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7751CD951 FOREIGN KEY (idEstab) REFERENCES etablissement (ID_Etablissement) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7BD280927 FOREIGN KEY (idPartnerCE) REFERENCES partner (idPartner) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EE7163212');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EE7163212');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EE7163212 FOREIGN KEY (id_res) REFERENCES reservation (id)');
        $this->addSql('DROP INDEX id_res ON paiement');
        $this->addSql('CREATE INDEX IDX_B1DC7A1EE7163212 ON paiement (id_res)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EE7163212 FOREIGN KEY (id_res) REFERENCES reservation (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY panier_ibfk_1');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_27448F77B251865F');
        $this->addSql('DROP INDEX panier_ibfk_1 ON panier');
        $this->addSql('DROP INDEX FK_27448F77B251865F ON panier');
        $this->addSql('ALTER TABLE panier DROP events, DROP reservations');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849556B3CA4B');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955D52B4B97');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849556B3CA4B');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955D52B4B97');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849556B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955D52B4B97 FOREIGN KEY (id_event) REFERENCES event (idEvent)');
        $this->addSql('DROP INDEX fk_user ON reservation');
        $this->addSql('CREATE INDEX IDX_42C849556B3CA4B ON reservation (id_user)');
        $this->addSql('DROP INDEX fk_event ON reservation');
        $this->addSql('CREATE INDEX IDX_42C84955D52B4B97 ON reservation (id_event)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849556B3CA4B FOREIGN KEY (id_user) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955D52B4B97 FOREIGN KEY (id_event) REFERENCES event (idEvent) ON UPDATE CASCADE ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE certificat (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7751CD951');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7BD280927');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7751CD951');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7BD280927');
        $this->addSql('ALTER TABLE event ADD paniers INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT event_ibfk_1 FOREIGN KEY (paniers) REFERENCES panier (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7751CD951 FOREIGN KEY (idEstab) REFERENCES etablissement (ID_Etablissement) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7BD280927 FOREIGN KEY (idPartnerCE) REFERENCES partner (idPartner) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX paniers ON event (paniers)');
        $this->addSql('DROP INDEX idx_3bae0aa7bd280927 ON event');
        $this->addSql('CREATE INDEX fk_partner ON event (idPartnerCE)');
        $this->addSql('DROP INDEX idx_3bae0aa7751cd951 ON event');
        $this->addSql('CREATE INDEX idEstab ON event (idEstab)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7751CD951 FOREIGN KEY (idEstab) REFERENCES etablissement (ID_Etablissement)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7BD280927 FOREIGN KEY (idPartnerCE) REFERENCES partner (idPartner)');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EE7163212');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EE7163212');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EE7163212 FOREIGN KEY (id_res) REFERENCES reservation (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_b1dc7a1ee7163212 ON paiement');
        $this->addSql('CREATE INDEX id_res ON paiement (id_res)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EE7163212 FOREIGN KEY (id_res) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE panier ADD events INT NOT NULL, ADD reservations INT NOT NULL');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT panier_ibfk_1 FOREIGN KEY (events) REFERENCES event (idEvent) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_27448F77B251865F FOREIGN KEY (reservations) REFERENCES reservation (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX panier_ibfk_1 ON panier (events)');
        $this->addSql('CREATE INDEX FK_27448F77B251865F ON panier (reservations)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849556B3CA4B');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955D52B4B97');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849556B3CA4B');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955D52B4B97');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849556B3CA4B FOREIGN KEY (id_user) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955D52B4B97 FOREIGN KEY (id_event) REFERENCES event (idEvent) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_42c84955d52b4b97 ON reservation');
        $this->addSql('CREATE INDEX fk_event ON reservation (id_event)');
        $this->addSql('DROP INDEX idx_42c849556b3ca4b ON reservation');
        $this->addSql('CREATE INDEX fk_user ON reservation (id_user)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849556B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955D52B4B97 FOREIGN KEY (id_event) REFERENCES event (idEvent)');
    }
}
