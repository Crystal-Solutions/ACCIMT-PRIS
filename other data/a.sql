
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`created_at`,`updated_at`,`name`,`epf_no`) VALUES 
 (1,'Janakact','A2IENsEgyzLc3wP79aSJiKWZa0k8OGoM','$2y$13$RHj9lf7I771ffK551ikHvO.JfnH6ds0cqGbKk2WOevmFKVmIx5iJ6',NULL,'janaka.13@cse.mrt.ac.lk',10,1438938614,1438938614,NULL,NULL),
 (2,'Shanika','xXJFyB_uaHxyR77RjPiQ2hx93To603Yp','$2y$13$uEQd1NhJaXAa0By6i9hiSuKejeyXRlnmgDzs2rt4vVxylozKhSylC',NULL,'shanika.13@cse.mrt.ac.lk',10,1438938687,1439311261,'Shanika Ediriweera','epf8888'),
 (3,'Rasika','X867c1omKqOyPTOg-ziND3e2jMFqW6k8','$2y$13$0to6y1NFIkHeJHr1K4TDM.PyuigPbasoHV1t4nf3k5P7MLjuvl/ti',NULL,'rasika@accmt.ac.lk',10,1438947706,1438947706,NULL,NULL),
 (4,'Ravindu','22uL-MOiwJXAL7GVFPQA-MjnEMjgYu3z','$2y$13$J1cU2fRc.Cj1m3A4D6u2K.axn8kH1YlHYBap7ugvUHMGx6lku.KiC',NULL,'ravindu.13@cse.mrt.ac.lk',10,1439311210,1439311210,'Ravindu Hasantha','epf9999'),
 (5,'ksajfdljalfasl','ll-0PuaGf0PxaP0XBYsDncIUjVMYe2F9','$2y$13$VDA..I0l97cregO4HtG57eZ1McwGXG7pYlM8gEnSEyoOW0ad20Tva',NULL,'asd@asd.com',10,1439313976,1439313976,'Sameera','kadjfls');





/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES 
 ('change-access-level',1,'allows system admin to change user access level',NULL,NULL,NULL,NULL),
 ('change-project-state',1,'allows ddg to change project state',NULL,NULL,NULL,NULL),
 ('create-auth-assignment',1,'allow user to create auth assignment',NULL,NULL,NULL,NULL),
 ('create-division',1,'allows system admin to create a new division',NULL,NULL,NULL,NULL),
 ('create-project',1,'allows an engineer to add a project',NULL,NULL,NULL,NULL),
 ('create-report',1,'allows sectional users to add sectional inputs',NULL,NULL,NULL,NULL),
 ('create-user',1,'allows system admin to create a new user',NULL,NULL,NULL,NULL),
 ('delete-auth-assignment',1,'allow user to delete auth assignment',NULL,NULL,NULL,NULL),
 ('delete-division',1,'allows user to delete division',NULL,NULL,NULL,NULL),
 ('delete-project',1,'allows user to delete a project',NULL,NULL,NULL,NULL),
 ('delete-report',1,'allows a user to delete a report',NULL,NULL,NULL,NULL),
 ('delete-user',1,'allows user to delete a user',NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES 
 ('deputy-director-genaral',2,'allows ddg to approve projects and to change project state',NULL,NULL,NULL,NULL),
 ('divisional-head',2,'allows divisional head to approve projects and approve project updates + create project and update',NULL,NULL,NULL,NULL),
 ('engineer',2,'allows user to create and update projects',NULL,NULL,NULL,NULL),
 ('mark-ddg-approval',1,'allows ddg to mark approval',NULL,NULL,NULL,NULL),
 ('mark-dh-approval',1,'allows the divisional head to mark approval',NULL,NULL,NULL,NULL),
 ('mark-report-approval',1,'allows sectional head to mark sectional input approval',NULL,NULL,NULL,NULL),
 ('mark-update-approval',1,'allows dh to mark approval for project updates',NULL,NULL,NULL,NULL),
 ('sectional-head',2,'allows user to approve and crud reports',NULL,NULL,NULL,NULL),
 ('sectional-staff',2,'allow user to crud reports',NULL,NULL,NULL,NULL),
 ('system-admin',2,'system admin can crud divisions, crud users, crud auth-assignment and change user access level',NULL,NULL,NULL,NULL),
 ('update-auth-assignment',1,'allow user to update auth assignment',NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES 
 ('update-division',1,'allows user to update division',NULL,NULL,NULL,NULL),
 ('update-project',1,'allows user to update project details',NULL,NULL,NULL,NULL),
 ('update-report',1,'allows user to update a report',NULL,NULL,NULL,NULL),
 ('update-user',1,'allows user to update a user',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;



/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES 
 ('system-admin','change-access-level'),
 ('deputy-director-genaral','change-project-state'),
 ('system-admin','create-auth-assignment'),
 ('system-admin','create-division'),
 ('divisional-head','create-project'),
 ('engineer','create-project'),
 ('sectional-head','create-report'),
 ('sectional-staff','create-report'),
 ('system-admin','create-user'),
 ('system-admin','delete-auth-assignment'),
 ('system-admin','delete-division'),
 ('divisional-head','delete-project'),
 ('sectional-head','delete-report'),
 ('sectional-staff','delete-report'),
 ('system-admin','delete-user'),
 ('deputy-director-genaral','mark-ddg-approval'),
 ('divisional-head','mark-dh-approval'),
 ('sectional-head','mark-report-approval'),
 ('divisional-head','mark-update-approval'),
 ('system-admin','update-auth-assignment'),
 ('system-admin','update-division'),
 ('divisional-head','update-project'),
 ('engineer','update-project'),
 ('sectional-head','update-report'),
 ('sectional-staff','update-report');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES 
 ('system-admin','update-user');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;



/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` (`item_name`,`user_id`,`created_at`) VALUES 
 ('divisional-head',1,NULL),
 ('divisional-head',5,NULL),
 ('engineer',2,NULL),
 ('engineer',5,NULL),
 ('system-admin',3,NULL);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;



/*!40000 ALTER TABLE `division_has_user` DISABLE KEYS */;
INSERT INTO `division_has_user` (`division_id`,`user_id`) VALUES 
 (2,2),
 (3,4),
 (1,5),
 (2,5);
/*!40000 ALTER TABLE `division_has_user` ENABLE KEYS */;

