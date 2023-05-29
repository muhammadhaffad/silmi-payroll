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

-- Dumping structure for trigger silmi-payroll.debts_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `debts_before_insert` BEFORE INSERT ON `debts` FOR EACH ROW BEGIN
SET NEW.sisa_hutang = NEW.hutang;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.debt_payments_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `debt_payments_after_insert` AFTER INSERT ON `debt_payments` FOR EACH ROW BEGIN
DECLARE total_cicilan INT;

SELECT COALESCE(SUM(cicilan), 0) INTO total_cicilan 
FROM debt_payments 
WHERE debt_payments.employee_nip = NEW.employee_nip AND debt_payments.debt_id = NEW.debt_id AND debt_payments.deleted_at IS NULL;

UPDATE debts SET debts.sisa_hutang = debts.hutang - total_cicilan WHERE id = NEW.debt_id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.debt_payments_after_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `debt_payments_after_update` AFTER UPDATE ON `debt_payments` FOR EACH ROW BEGIN
DECLARE total_cicilan INT;

SELECT COALESCE(SUM(cicilan), 0) INTO total_cicilan 
FROM debt_payments 
WHERE debt_payments.employee_nip = NEW.employee_nip AND debt_payments.debt_id = NEW.debt_id AND debt_payments.deleted_at IS NULL;

UPDATE debts SET debts.sisa_hutang = debts.hutang - total_cicilan WHERE id = NEW.debt_id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.etc_allowances_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `etc_allowances_after_insert` AFTER INSERT ON `etc_allowances` FOR EACH ROW BEGIN
	DECLARE fixed_allowance_count INT;
	DECLARE lainlain_total INT;
	
	SELECT COUNT(*) INTO fixed_allowance_count
	FROM fixed_allowances
	WHERE fixed_allowances.employee_nip = NEW.employee_nip AND fixed_allowances.deleted_at IS NULL;
	
	SELECT COALESCE(SUM(etc_allowances.jumlah), 0) INTO lainlain_total
	FROM etc_allowances
	WHERE etc_allowances.employee_nip = NEW.employee_nip AND etc_allowances.deleted_at IS NULL;
	
	IF fixed_allowance_count > 0 THEN
		UPDATE fixed_allowances SET fixed_allowances.lain_lain = lainlain_total WHERE fixed_allowances.employee_nip = NEW.employee_nip;
	ELSE
		INSERT INTO fixed_allowances (employee_nip, lain_lain) VALUES (NEW.employee_nip, lainlain_total);
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.etc_allowances_after_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `etc_allowances_after_update` AFTER UPDATE ON `etc_allowances` FOR EACH ROW BEGIN
	DECLARE fixed_allowance_count INT;
	DECLARE lainlain_total INT;
	
	SELECT COUNT(*) INTO fixed_allowance_count
	FROM fixed_allowances
	WHERE fixed_allowances.employee_nip = NEW.employee_nip AND fixed_allowances.deleted_at IS NULL;
	
	SELECT COALESCE(SUM(etc_allowances.jumlah), 0) INTO lainlain_total
	FROM etc_allowances
	WHERE etc_allowances.employee_nip = NEW.employee_nip AND etc_allowances.deleted_at IS NULL;
	
	IF fixed_allowance_count > 0 THEN
		UPDATE fixed_allowances SET fixed_allowances.lain_lain = lainlain_total WHERE fixed_allowances.employee_nip = NEW.employee_nip;
	ELSE
		INSERT INTO fixed_allowances (employee_nip, lain_lain) VALUES (NEW.employee_nip, lainlain_total);
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.expertise_allowances_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `expertise_allowances_after_insert` AFTER INSERT ON `expertise_allowances` FOR EACH ROW BEGIN
	DECLARE fixed_allowance_count INT;
	DECLARE keahlian_total INT;
	
	SELECT COUNT(*) INTO fixed_allowance_count
	FROM fixed_allowances
	WHERE fixed_allowances.employee_nip = NEW.employee_nip AND fixed_allowances.deleted_at IS NULL;
	
	SELECT COALESCE(SUM(expertise_allowances.jumlah), 0) INTO keahlian_total
	FROM expertise_allowances
	WHERE expertise_allowances.employee_nip = NEW.employee_nip AND expertise_allowances.deleted_at IS NULL;
	
	IF fixed_allowance_count > 0 THEN
		UPDATE fixed_allowances SET fixed_allowances.keahlian = keahlian_total WHERE fixed_allowances.employee_nip = NEW.employee_nip;
	ELSE
		INSERT INTO fixed_allowances (employee_nip, keahlian) VALUES (NEW.employee_nip, keahlian_total);
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.expertise_allowances_after_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `expertise_allowances_after_update` AFTER UPDATE ON `expertise_allowances` FOR EACH ROW BEGIN
	DECLARE fixed_allowance_count INT;
	DECLARE keahlian_total INT;
	
	SELECT COUNT(*) INTO fixed_allowance_count
	FROM fixed_allowances
	WHERE fixed_allowances.employee_nip = NEW.employee_nip AND fixed_allowances.deleted_at IS NULL;
	
	SELECT COALESCE(SUM(expertise_allowances.jumlah), 0) INTO keahlian_total
	FROM expertise_allowances
	WHERE expertise_allowances.employee_nip = NEW.employee_nip AND expertise_allowances.deleted_at IS NULL;
	
	IF fixed_allowance_count > 0 THEN
		UPDATE fixed_allowances SET fixed_allowances.keahlian = keahlian_total WHERE fixed_allowances.employee_nip = NEW.employee_nip;
	ELSE
		INSERT INTO fixed_allowances (employee_nip, keahlian) VALUES (NEW.employee_nip, keahlian_total);
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.fixed_allowances_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `fixed_allowances_before_insert` BEFORE INSERT ON `fixed_allowances` FOR EACH ROW BEGIN
SET NEW.total = NEW.keahlian + NEW.kepala_keluarga + NEW.masa_kerja + NEW.operasional + NEW.lain_lain + NEW.lembur + NEW.reward - NEW.infaq - NEW.cicilan;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.fixed_allowances_before_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `fixed_allowances_before_update` BEFORE UPDATE ON `fixed_allowances` FOR EACH ROW BEGIN
SET NEW.total = NEW.keahlian + NEW.kepala_keluarga + NEW.masa_kerja + NEW.operasional + NEW.lain_lain + NEW.lembur + NEW.reward - NEW.infaq - NEW.cicilan;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.household_allowances_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `household_allowances_after_insert` AFTER INSERT ON `household_allowances` FOR EACH ROW BEGIN
	DECLARE fixed_allowance_count INT;
	DECLARE kepala_keluarga_total INT;
	
	SELECT COUNT(*) INTO fixed_allowance_count
	FROM fixed_allowances
	WHERE fixed_allowances.employee_nip = NEW.employee_nip AND fixed_allowances.deleted_at IS NULL;
	
	SELECT COALESCE(SUM(household_allowances.jumlah), 0) INTO kepala_keluarga_total
	FROM household_allowances
	WHERE household_allowances.employee_nip = NEW.employee_nip AND household_allowances.deleted_at IS NULL;
	
	IF fixed_allowance_count > 0 THEN
		UPDATE fixed_allowances SET fixed_allowances.kepala_keluarga = kepala_keluarga_total WHERE fixed_allowances.employee_nip = NEW.employee_nip;
	ELSE
		INSERT INTO fixed_allowances (employee_nip, kepala_keluarga) VALUES (NEW.employee_nip, kepala_keluarga_total);
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.household_allowances_after_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `household_allowances_after_update` AFTER UPDATE ON `household_allowances` FOR EACH ROW BEGIN
	DECLARE fixed_allowance_count INT;
	DECLARE kepala_keluarga_total INT;
	
	SELECT COUNT(*) INTO fixed_allowance_count
	FROM fixed_allowances
	WHERE fixed_allowances.employee_nip = NEW.employee_nip AND fixed_allowances.deleted_at IS NULL;
	
	SELECT COALESCE(SUM(household_allowances.jumlah), 0) INTO kepala_keluarga_total
	FROM household_allowances
	WHERE household_allowances.employee_nip = NEW.employee_nip AND household_allowances.deleted_at IS NULL;
	
	IF fixed_allowance_count > 0 THEN
		UPDATE fixed_allowances SET fixed_allowances.kepala_keluarga = kepala_keluarga_total WHERE fixed_allowances.employee_nip = NEW.employee_nip;
	ELSE
		INSERT INTO fixed_allowances (employee_nip, kepala_keluarga) VALUES (NEW.employee_nip, kepala_keluarga_total);
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.infaqs_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `infaqs_after_insert` AFTER INSERT ON `infaqs` FOR EACH ROW BEGIN
	DECLARE fixed_allowance_count INT;
	DECLARE infaq_total INT;
	
	SELECT COUNT(*) INTO fixed_allowance_count
	FROM fixed_allowances
	WHERE fixed_allowances.employee_nip = NEW.employee_nip AND fixed_allowances.deleted_at IS NULL;
	
	SELECT COALESCE(SUM(infaqs.jumlah), 0) INTO infaq_total
	FROM infaqs
	WHERE infaqs.employee_nip = NEW.employee_nip AND infaqs.deleted_at IS NULL;
	
	IF fixed_allowance_count > 0 THEN
		UPDATE fixed_allowances SET fixed_allowances.infaq = infaq_total WHERE fixed_allowances.employee_nip = NEW.employee_nip;
	ELSE
		INSERT INTO fixed_allowances (employee_nip, infaq) VALUES (NEW.employee_nip, infaq_total);
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.infaqs_after_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `infaqs_after_update` AFTER UPDATE ON `infaqs` FOR EACH ROW BEGIN
	DECLARE fixed_allowance_count INT;
	DECLARE infaq_total INT;
	
	SELECT COUNT(*) INTO fixed_allowance_count
	FROM fixed_allowances
	WHERE fixed_allowances.employee_nip = NEW.employee_nip AND fixed_allowances.deleted_at IS NULL;
	
	SELECT COALESCE(SUM(infaqs.jumlah), 0) INTO infaq_total
	FROM infaqs
	WHERE infaqs.employee_nip = NEW.employee_nip AND infaqs.deleted_at IS NULL;
	
	IF fixed_allowance_count > 0 THEN
		UPDATE fixed_allowances SET fixed_allowances.infaq = infaq_total WHERE fixed_allowances.employee_nip = NEW.employee_nip;
	ELSE
		INSERT INTO fixed_allowances (employee_nip, infaq) VALUES (NEW.employee_nip, infaq_total);
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.installments_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `installments_after_insert` AFTER INSERT ON `installments` FOR EACH ROW BEGIN
	DECLARE fixed_allowance_count INT;
	DECLARE cicilan_total INT;
	
	SELECT COUNT(*) INTO fixed_allowance_count
	FROM fixed_allowances
	WHERE fixed_allowances.employee_nip = NEW.employee_nip AND fixed_allowances.deleted_at IS NULL;
	
	SELECT COALESCE(SUM(installments.jumlah), 0) INTO cicilan_total
	FROM installments
	WHERE installments.employee_nip = NEW.employee_nip AND installments.deleted_at IS NULL;
	
	IF fixed_allowance_count > 0 THEN
		UPDATE fixed_allowances SET fixed_allowances.cicilan = cicilan_total WHERE fixed_allowances.employee_nip = NEW.employee_nip;
	ELSE
		INSERT INTO fixed_allowances (employee_nip, cicilan) VALUES (NEW.employee_nip, cicilan_total);
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.installments_after_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `installments_after_update` AFTER UPDATE ON `installments` FOR EACH ROW BEGIN
	DECLARE fixed_allowance_count INT;
	DECLARE cicilan_total INT;
	
	SELECT COUNT(*) INTO fixed_allowance_count
	FROM fixed_allowances
	WHERE fixed_allowances.employee_nip = NEW.employee_nip AND fixed_allowances.deleted_at IS NULL;
	
	SELECT COALESCE(SUM(installments.jumlah), 0) INTO cicilan_total
	FROM installments
	WHERE installments.employee_nip = NEW.employee_nip AND installments.deleted_at IS NULL;
	
	IF fixed_allowance_count > 0 THEN
		UPDATE fixed_allowances SET fixed_allowances.cicilan = cicilan_total WHERE fixed_allowances.employee_nip = NEW.employee_nip;
	ELSE
		INSERT INTO fixed_allowances (employee_nip, cicilan) VALUES (NEW.employee_nip, cicilan_total);
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.operational_allowances_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `operational_allowances_after_insert` AFTER INSERT ON `operational_allowances` FOR EACH ROW BEGIN
	DECLARE fixed_allowance_count INT;
	DECLARE operasional_total INT;
	
	SELECT COUNT(*) INTO fixed_allowance_count
	FROM fixed_allowances
	WHERE fixed_allowances.employee_nip = NEW.employee_nip AND fixed_allowances.deleted_at IS NULL;
	
	SELECT COALESCE(SUM(operational_allowances.jumlah), 0) INTO operasional_total
	FROM operational_allowances
	WHERE operational_allowances.employee_nip = NEW.employee_nip AND operational_allowances.deleted_at IS NULL;
	
	IF fixed_allowance_count > 0 THEN
		UPDATE fixed_allowances SET fixed_allowances.operasional = operasional_total WHERE fixed_allowances.employee_nip = NEW.employee_nip;
	ELSE
		INSERT INTO fixed_allowances (employee_nip, operasional) VALUES (NEW.employee_nip, operasional_total);
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.operational_allowances_after_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `operational_allowances_after_update` AFTER UPDATE ON `operational_allowances` FOR EACH ROW BEGIN
	DECLARE fixed_allowance_count INT;
	DECLARE operasional_total INT;
	
	SELECT COUNT(*) INTO fixed_allowance_count
	FROM fixed_allowances
	WHERE fixed_allowances.employee_nip = NEW.employee_nip AND fixed_allowances.deleted_at IS NULL;
	
	SELECT COALESCE(SUM(operational_allowances.jumlah), 0) INTO operasional_total
	FROM operational_allowances
	WHERE operational_allowances.employee_nip = NEW.employee_nip AND operational_allowances.deleted_at IS NULL;
	
	IF fixed_allowance_count > 0 THEN
		UPDATE fixed_allowances SET fixed_allowances.operasional = operasional_total WHERE fixed_allowances.employee_nip = NEW.employee_nip;
	ELSE
		INSERT INTO fixed_allowances (employee_nip, operasional) VALUES (NEW.employee_nip, operasional_total);
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.overtimes_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `overtimes_after_insert` AFTER INSERT ON `overtimes` FOR EACH ROW BEGIN
	DECLARE fixed_allowance_count INT;
	DECLARE lembur_total INT;
	
	SELECT COUNT(*) INTO fixed_allowance_count
	FROM fixed_allowances
	WHERE fixed_allowances.employee_nip = NEW.employee_nip AND fixed_allowances.deleted_at IS NULL;
	
	SELECT COALESCE(SUM(overtimes.jumlah), 0) INTO lembur_total
	FROM overtimes
	WHERE overtimes.employee_nip = NEW.employee_nip AND overtimes.deleted_at IS NULL;
	
	IF fixed_allowance_count > 0 THEN
		UPDATE fixed_allowances SET fixed_allowances.lembur = lembur_total WHERE fixed_allowances.employee_nip = NEW.employee_nip;
	ELSE
		INSERT INTO fixed_allowances (employee_nip, lembur) VALUES (NEW.employee_nip, lembur_total);
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.overtimes_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `overtimes_before_insert` BEFORE INSERT ON `overtimes` FOR EACH ROW BEGIN
	DECLARE perjam_var DOUBLE;
	
	SELECT perjam INTO perjam_var 
	FROM variable_allowances
	WHERE variable_allowances.employee_nip = NEW.employee_nip AND variable_allowances.deleted_at IS NULL;
	
	SET NEW.perjam = perjam_var;
	SET NEW.total_jam = NEW.jumlah / perjam_var;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.overtimes_before_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `overtimes_before_update` BEFORE UPDATE ON `overtimes` FOR EACH ROW BEGIN
DECLARE perjam_var DOUBLE;

SELECT perjam INTO perjam_var 
FROM variable_allowances
WHERE variable_allowances.employee_nip = NEW.employee_nip AND variable_allowances.deleted_at IS NULL;

SET NEW.perjam = perjam_var;
SET NEW.total_jam = NEW.jumlah / perjam_var;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.rewards_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `rewards_after_insert` AFTER INSERT ON `rewards` FOR EACH ROW BEGIN
	DECLARE fixed_allowance_count INT;
	DECLARE reward_total INT;
	
	SELECT COUNT(*) INTO fixed_allowance_count
	FROM fixed_allowances
	WHERE fixed_allowances.employee_nip = NEW.employee_nip AND fixed_allowances.deleted_at IS NULL;
	
	SELECT COALESCE(SUM(rewards.jumlah), 0) INTO reward_total
	FROM rewards
	WHERE rewards.employee_nip = NEW.employee_nip AND rewards.deleted_at IS NULL;
	
	IF fixed_allowance_count > 0 THEN
		UPDATE fixed_allowances SET fixed_allowances.reward = reward_total WHERE fixed_allowances.employee_nip = NEW.employee_nip;
	ELSE
		INSERT INTO fixed_allowances (employee_nip, reward) VALUES (NEW.employee_nip, reward_total);
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.rewards_after_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `rewards_after_update` AFTER UPDATE ON `rewards` FOR EACH ROW BEGIN
	DECLARE fixed_allowance_count INT;
	DECLARE reward_total INT;
	
	SELECT COUNT(*) INTO fixed_allowance_count
	FROM fixed_allowances
	WHERE fixed_allowances.employee_nip = NEW.employee_nip AND fixed_allowances.deleted_at IS NULL;
	
	SELECT COALESCE(SUM(rewards.jumlah), 0) INTO reward_total
	FROM rewards
	WHERE rewards.employee_nip = NEW.employee_nip AND rewards.deleted_at IS NULL;
	
	IF fixed_allowance_count > 0 THEN
		UPDATE fixed_allowances SET fixed_allowances.reward = reward_total WHERE fixed_allowances.employee_nip = NEW.employee_nip;
	ELSE
		INSERT INTO fixed_allowances (employee_nip, reward) VALUES (NEW.employee_nip, reward_total);
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.seniority_allowances_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `seniority_allowances_after_insert` AFTER INSERT ON `seniority_allowances` FOR EACH ROW BEGIN
	DECLARE fixed_allowance_count INT;
	DECLARE masa_kerja_total INT;
	
	SELECT COUNT(*) INTO fixed_allowance_count
	FROM fixed_allowances
	WHERE fixed_allowances.employee_nip = NEW.employee_nip AND fixed_allowances.deleted_at IS NULL;
	
	SELECT COALESCE(SUM(seniority_allowances.jumlah), 0) INTO masa_kerja_total
	FROM seniority_allowances
	WHERE seniority_allowances.employee_nip = NEW.employee_nip AND seniority_allowances.deleted_at IS NULL;
	
	IF fixed_allowance_count > 0 THEN
		UPDATE fixed_allowances SET fixed_allowances.masa_kerja = masa_kerja_total WHERE fixed_allowances.employee_nip = NEW.employee_nip;
	ELSE
		INSERT INTO fixed_allowances (employee_nip, masa_kerja) VALUES (NEW.employee_nip, masa_kerja_total);
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.seniority_allowances_after_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `seniority_allowances_after_update` AFTER UPDATE ON `seniority_allowances` FOR EACH ROW BEGIN
	DECLARE fixed_allowance_count INT;
	DECLARE masa_kerja_total INT;
	
	SELECT COUNT(*) INTO fixed_allowance_count
	FROM fixed_allowances
	WHERE fixed_allowances.employee_nip = NEW.employee_nip AND fixed_allowances.deleted_at IS NULL;
	
	SELECT COALESCE(SUM(seniority_allowances.jumlah), 0) INTO masa_kerja_total
	FROM seniority_allowances
	WHERE seniority_allowances.employee_nip = NEW.employee_nip AND seniority_allowances.deleted_at IS NULL;
	
	IF fixed_allowance_count > 0 THEN
		UPDATE fixed_allowances SET fixed_allowances.masa_kerja = masa_kerja_total WHERE fixed_allowances.employee_nip = NEW.employee_nip;
	ELSE
		INSERT INTO fixed_allowances (employee_nip, masa_kerja) VALUES (NEW.employee_nip, masa_kerja_total);
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger silmi-payroll.variable_allowances_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `variable_allowances_before_insert` BEFORE INSERT ON `variable_allowances` FOR EACH ROW BEGIN
	SET NEW.perjam = (NEW.gaji_pokok + NEW.tunjangan_jabatan) / 182;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
