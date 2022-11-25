CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
); /* User information - Used */

CREATE TABLE app_info(
    apps_sl_no INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    swc_id VARCHAR(10) NOT NULL UNIQUE,
    apps_name VARCHAR(30) NOT NULL UNIQUE,
    lob VARCHAR(20),
    irr INT NOT NULL,
    usa_usage VARCHAR(10),
    cri_sen VARCHAR(10),
    in_scope VARCHAR(10),
    in_date DATE,
    mlsi VARCHAR(10),
    user_id VARCHAR(15) NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
); /* Application Related Information - Used */

CREATE TABLE contact_info(
  sl_no INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  swc_id VARCHAR(10),
  name VARCHAR(30),
  gpn INT,
  position VARCHAR(15),
  user_id VARCHAR(15) NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
); /* Contact Information - Used */


CREATE TABLE enforcement_info(
  apps_sl_no INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  swc_id VARCHAR(10) NOT NULL,
  present_status VARCHAR(25) NULL,
  present_sub_status VARCHAR(50) NULL,
  overall_status VARCHAR(15) NULL,
  enforcement_solution VARCHAR(15) NULL,
  exception_criteria VARCHAR(15) NULL,
  enforcement_date_av VARCHAR(15) NULL,
  exception_expire_date_av VARCHAR(15) NULL,
  enforcement_date DATE DEFAULT NULL,
  exception_expire_date DATE DEFAULT NULL,
  justtification VARCHAR(200),
  risk_statement VARCHAR(200),
  comms VARCHAR(200) NULL,
  user_id VARCHAR(15) NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
/* column - comms - It will delet in future databse */
/* Database name will changed */
/* Application Status Information */

CREATE TABLE comment_info(
  comms_sl_no INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  swc_id VARCHAR(10) NOT NULL,
  enforcement_sl_no VARCHAR(10) NULL,
  comms VARCHAR(300) NULL,
  user_id VARCHAR(10) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE exception_details_info(
  exception_details_sl_no INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  swc_id VARCHAR(10) NOT NULL,
  exception_category VARCHAR(25), /* it should be the same as like as exception_criteria in enforcement_table*/
  two_fa_planned VARCHAR(25),
  two_fa_seems_possible VARCHAR(25),
  remediation_feasibility VARCHAR(25),
  exception_future_status VARCHAR(25),
  proposal VARCHAR(500),
  two_fa_proposed_date DATE,
  user_id VARCHAR(15) NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
/* Application Exception Details Information */
