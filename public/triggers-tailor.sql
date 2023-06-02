-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for silmi-payroll-tailor
CREATE DATABASE IF NOT EXISTS `silmi-payroll-tailor` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `silmi-payroll-tailor`;

-- Dumping structure for trigger silmi-payroll-tailor.employees_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `employees_after_insert` AFTER INSERT ON `employees` FOR EACH ROW BEGIN

INSERT sewing_compensation_rules (employee_id, min_total_jahit, maks_total_jahit, inclusive_min, inclusive_maks, kompensasi_persen, created_at, updated_at) 
VALUES 
(NEW.id, 0, 1000000, TRUE, TRUE, 10, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()),
(NEW.id, 1000000, 3000000, FALSE, TRUE, 20, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()),
(NEW.id, 3000000, 5000000, FALSE, TRUE, 25, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()),
(NEW.id, 5000000, 999999999, FALSE, TRUE, 30, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());

INSERT installments (employee_id, jumlah, created_at, updated_at)
VALUES
(NEW.id, 0, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());

INSERT trimmings (employee_id, jumlah, created_at, updated_at)
VALUES
(NEW.id, 0, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());

INSERT infaqs (employee_id, jumlah, created_at, updated_at)
VALUES
(NEW.id, 0, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());

END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll-tailor.sewing_defects_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `sewing_defects_before_insert` BEFORE INSERT ON `sewing_defects` FOR EACH ROW BEGIN
DECLARE kompensasi_cacat_persen_var INT;

SELECT kompensasi_persen INTO kompensasi_cacat_persen_var 
FROM sewing_defect_rules
WHERE ((min_cacat_persen <= NEW.cacat_persen AND maks_cacat_persen >= NEW.cacat_persen AND inclusive_min = TRUE AND inclusive_maks = TRUE) 
	OR (min_cacat_persen < NEW.cacat_persen AND maks_cacat_persen >= NEW.cacat_persen AND inclusive_min = FALSE AND inclusive_maks = TRUE) 
	OR (min_cacat_persen <= NEW.cacat_persen AND maks_cacat_persen > NEW.cacat_persen AND inclusive_min = TRUE AND inclusive_maks = FALSE) 
	OR (min_cacat_persen < NEW.cacat_persen AND maks_cacat_persen > NEW.cacat_persen AND inclusive_min = FALSE AND inclusive_maks = FALSE))
	AND deleted_at IS NULL LIMIT 1;
	
SET NEW.kompensasi_persen = kompensasi_cacat_persen_var;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll-tailor.sewing_defects_before_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `sewing_defects_before_update` BEFORE UPDATE ON `sewing_defects` FOR EACH ROW BEGIN
DECLARE kompensasi_cacat_persen_var INT;

SELECT kompensasi_persen INTO kompensasi_cacat_persen_var 
FROM sewing_defect_rules
WHERE ((min_cacat_persen <= NEW.cacat_persen AND maks_cacat_persen >= NEW.cacat_persen AND inclusive_min = TRUE AND inclusive_maks = TRUE) 
	OR (min_cacat_persen < NEW.cacat_persen AND maks_cacat_persen >= NEW.cacat_persen AND inclusive_min = FALSE AND inclusive_maks = TRUE) 
	OR (min_cacat_persen <= NEW.cacat_persen AND maks_cacat_persen > NEW.cacat_persen AND inclusive_min = TRUE AND inclusive_maks = FALSE) 
	OR (min_cacat_persen < NEW.cacat_persen AND maks_cacat_persen > NEW.cacat_persen AND inclusive_min = FALSE AND inclusive_maks = FALSE))
	AND deleted_at IS NULL LIMIT 1;
	
SET NEW.kompensasi_persen = kompensasi_cacat_persen_var;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll-tailor.sewing_needs_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `sewing_needs_before_insert` BEFORE INSERT ON `sewing_needs` FOR EACH ROW BEGIN
DECLARE harga_var BIGINT;

SELECT IFNULL(sewing_supplies.harga, 0) INTO harga_var 
FROM sewing_supplies
WHERE id = NEW.sewing_supply_id AND deleted_at IS NULL;

SET NEW.total = NEW.qty * harga_var;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll-tailor.sewing_needs_before_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `sewing_needs_before_update` BEFORE UPDATE ON `sewing_needs` FOR EACH ROW BEGIN
DECLARE harga_var BIGINT;

SELECT IFNULL(sewing_supplies.harga, 0) INTO harga_var 
FROM sewing_supplies
WHERE id = NEW.sewing_supply_id AND deleted_at IS NULL;

SET NEW.total = NEW.qty * harga_var;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll-tailor.sewing_tasks_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `sewing_tasks_after_insert` AFTER INSERT ON `sewing_tasks` FOR EACH ROW BEGIN
DECLARE total_jahit_var BIGINT;
DECLARE kompensasi_total_jahit_persen_var INT;

SELECT IFNULL(SUM(total), 0) INTO total_jahit_var
FROM sewing_tasks
WHERE sewing_tasks.employee_id = NEW.employee_id AND sewing_tasks.deleted_at IS NULL;

SELECT kompensasi_persen INTO kompensasi_total_jahit_persen_var 
FROM sewing_compensation_rules
WHERE ((min_total_jahit <= total_jahit_var AND maks_total_jahit >= total_jahit_var AND inclusive_min = TRUE AND inclusive_maks = TRUE) 
	OR (min_total_jahit < total_jahit_var AND maks_total_jahit >= total_jahit_var AND inclusive_min = FALSE AND inclusive_maks = TRUE) 
	OR (min_total_jahit <= total_jahit_var AND maks_total_jahit > total_jahit_var AND inclusive_min = TRUE AND inclusive_maks = FALSE) 
	OR (min_total_jahit < total_jahit_var AND maks_total_jahit > total_jahit_var AND inclusive_min = FALSE AND inclusive_maks = FALSE))
	AND employee_id = NEW.employee_id AND deleted_at IS NULL LIMIT 1;
	
IF (SELECT COUNT(*) FROM sewing_compensation WHERE sewing_compensation.employee_id = NEW.employee_id AND deleted_at IS NULL > 0) THEN
	UPDATE sewing_compensation 
	SET total_jahit = total_jahit_var, kompensasi_persen = kompensasi_total_jahit_persen_var, updated_at = CURRENT_TIMESTAMP()
	WHERE employee_id = NEW.employee_id AND deleted_at IS NULL;
ELSE
	INSERT sewing_compensation (employee_id, total_jahit, kompensasi_persen, created_at, updated_at)
	VALUES (NEW.employee_id, total_jahit_var, kompensasi_total_jahit_persen_var, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll-tailor.sewing_tasks_after_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `sewing_tasks_after_update` AFTER UPDATE ON `sewing_tasks` FOR EACH ROW BEGIN
DECLARE total_jahit_var BIGINT;
DECLARE kompensasi_total_jahit_persen_var INT;

SELECT IFNULL(SUM(total), 0) INTO total_jahit_var
FROM sewing_tasks
WHERE sewing_tasks.employee_id = NEW.employee_id AND sewing_tasks.deleted_at IS NULL;

SELECT kompensasi_persen INTO kompensasi_total_jahit_persen_var 
FROM sewing_compensation_rules
WHERE ((min_total_jahit <= total_jahit_var AND maks_total_jahit >= total_jahit_var AND inclusive_min = TRUE AND inclusive_maks = TRUE) 
	OR (min_total_jahit < total_jahit_var AND maks_total_jahit >= total_jahit_var AND inclusive_min = FALSE AND inclusive_maks = TRUE) 
	OR (min_total_jahit <= total_jahit_var AND maks_total_jahit > total_jahit_var AND inclusive_min = TRUE AND inclusive_maks = FALSE) 
	OR (min_total_jahit < total_jahit_var AND maks_total_jahit > total_jahit_var AND inclusive_min = FALSE AND inclusive_maks = FALSE))
	AND employee_id = NEW.employee_id AND deleted_at IS NULL LIMIT 1;
	
IF (SELECT COUNT(*) FROM sewing_compensation WHERE sewing_compensation.employee_id = NEW.employee_id AND deleted_at IS NULL > 0) THEN
	UPDATE sewing_compensation 
	SET total_jahit = total_jahit_var, kompensasi_persen = kompensasi_total_jahit_persen_var, updated_at = CURRENT_TIMESTAMP()
	WHERE employee_id = NEW.employee_id AND deleted_at IS NULL;
ELSE
	INSERT sewing_compensation (employee_id, total_jahit, kompensasi_persen, created_at, updated_at)
	VALUES (NEW.employee_id, total_jahit_var, kompensasi_total_jahit_persen_var, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll-tailor.sewing_tasks_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `sewing_tasks_before_insert` BEFORE INSERT ON `sewing_tasks` FOR EACH ROW BEGIN
DECLARE jumlah_var BIGINT;

SELECT IFNULL(sewings.total, 0) INTO jumlah_var 
FROM sewings
WHERE sewings.id = NEW.sewing_id AND sewings.deleted_at IS NULL;

SET NEW.total = NEW.qty * jumlah_var;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll-tailor.sewing_tasks_before_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `sewing_tasks_before_update` BEFORE UPDATE ON `sewing_tasks` FOR EACH ROW BEGIN
DECLARE jumlah_var BIGINT;

SELECT IFNULL(sewings.total, 0) INTO jumlah_var 
FROM sewings
WHERE sewings.id = NEW.sewing_id AND sewings.deleted_at IS NULL;

SET NEW.total = NEW.qty * jumlah_var;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
