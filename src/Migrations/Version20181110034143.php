<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181110034143 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE barbecue (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, properties LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', model VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, location_lat VARCHAR(255) NOT NULL, location_lng VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, picture_name VARCHAR(255) DEFAULT NULL, picture_original_name VARCHAR(255) DEFAULT NULL, picture_mime_type VARCHAR(255) DEFAULT NULL, picture_size INT DEFAULT NULL, picture_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', INDEX IDX_56CCDD35A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rent (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, barbecue_id INT DEFAULT NULL, date DATE NOT NULL, INDEX IDX_2784DCCA76ED395 (user_id), INDEX IDX_2784DCCE2A5D7D4 (barbecue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', country VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_957A6479C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE barbecue ADD CONSTRAINT FK_56CCDD35A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCCA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCCE2A5D7D4 FOREIGN KEY (barbecue_id) REFERENCES barbecue (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rent DROP FOREIGN KEY FK_2784DCCE2A5D7D4');
        $this->addSql('ALTER TABLE barbecue DROP FOREIGN KEY FK_56CCDD35A76ED395');
        $this->addSql('ALTER TABLE rent DROP FOREIGN KEY FK_2784DCCA76ED395');
        $this->addSql('DROP TABLE barbecue');
        $this->addSql('DROP TABLE rent');
        $this->addSql('DROP TABLE fos_user');
    }
}
