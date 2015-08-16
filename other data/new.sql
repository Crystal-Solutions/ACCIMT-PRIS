
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('change-access-level', 1, 'allows system admin to change user access level', NULL, NULL, NULL, NULL),
('change-project-state', 1, 'allows ddg to change project state', NULL, NULL, NULL, NULL),
('create-auth-assignment', 1, 'allow user to create auth assignment', NULL, NULL, NULL, NULL),
('create-division', 1, 'allows system admin to create a new division', NULL, NULL, NULL, NULL),
('create-project', 1, 'allows an engineer to add a project', NULL, NULL, NULL, NULL),
('create-report', 1, 'allows sectional users to add sectional inputs', NULL, NULL, NULL, NULL),
('create-user', 1, 'allows system admin to create a new user', NULL, NULL, NULL, NULL),
('delete-auth-assignment', 1, 'allow user to delete auth assignment', NULL, NULL, NULL, NULL),
('delete-division', 1, 'allows user to delete division', NULL, NULL, NULL, NULL),
('delete-project', 1, 'allows user to delete a project', NULL, NULL, NULL, NULL),
('delete-report', 1, 'allows a user to delete a report', NULL, NULL, NULL, NULL),
('delete-user', 1, 'allows user to delete a user', NULL, NULL, NULL, NULL),
('deputy-director-genaral', 2, 'allows ddg to approve projects and to change project state', NULL, NULL, NULL, NULL),
('divisional-head', 2, 'allows divisional head to approve projects and approve project updates + create project and update', NULL, NULL, NULL, NULL),
('engineer', 2, 'allows user to create and update projects', NULL, NULL, NULL, NULL),
('mark-ddg-approval', 1, 'allows ddg to mark approval', NULL, NULL, NULL, NULL),
('mark-dh-approval', 1, 'allows the divisional head to mark approval', NULL, NULL, NULL, NULL),
('mark-report-approval', 1, 'allows sectional head to mark sectional input approval', NULL, NULL, NULL, NULL),
('mark-update-approval', 1, 'allows dh to mark approval for project updates', NULL, NULL, NULL, NULL),
('sectional-head', 2, 'allows user to approve and crud reports', NULL, NULL, NULL, NULL),
('sectional-staff', 2, 'allow user to crud reports', NULL, NULL, NULL, NULL),
('system-admin', 2, 'system admin can crud divisions, crud users, crud auth-assignment and change user access level', NULL, NULL, NULL, NULL),
('update-auth-assignment', 1, 'allow user to update auth assignment', NULL, NULL, NULL, NULL),
('update-division', 1, 'allows user to update division', NULL, NULL, NULL, NULL),
('update-project', 1, 'allows user to update project details', NULL, NULL, NULL, NULL),
('update-report', 1, 'allows user to update a report', NULL, NULL, NULL, NULL),
('update-user', 1, 'allows user to update a user', NULL, NULL, NULL, NULL);


INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('system-admin', 'change-access-level'),
('deputy-director-genaral', 'change-project-state'),
('system-admin', 'create-auth-assignment'),
('system-admin', 'create-division'),
('divisional-head', 'create-project'),
('engineer', 'create-project'),
('sectional-head', 'create-report'),
('sectional-staff', 'create-report'),
('system-admin', 'create-user'),
('system-admin', 'delete-auth-assignment'),
('system-admin', 'delete-division'),
('divisional-head', 'delete-project'),
('sectional-head', 'delete-report'),
('sectional-staff', 'delete-report'),
('system-admin', 'delete-user'),
('deputy-director-genaral', 'mark-ddg-approval'),
('divisional-head', 'mark-dh-approval'),
('sectional-head', 'mark-report-approval'),
('divisional-head', 'mark-update-approval'),
('system-admin', 'update-auth-assignment'),
('system-admin', 'update-division'),
('divisional-head', 'update-project'),
('sectional-head', 'update-report'),
('sectional-staff', 'update-report'),
('system-admin', 'update-user');


 
INSERT INTO `division` (`id`, `name`, `description`) VALUES
(1, 'Electronics & Microelectronics Division', 'Conduct research & development work related to electronics, telecommunications, robotics and automation'),
(2, 'Information Technology Division', 'Software translation, computer vision and assistance for e-governance'),
(3, 'Space Technologies Division', 'Research work on RS/GIS, Space Technology based National Capacity Development, Research work on Astronomy, Astronomy popularization programme'),
(4, 'Communication Division', 'Currently include activities of Robotics'),
(5, 'Industrial Services Division', 'Provide consultancy services to the electronic industry and perform repair & calibration  services of test and measuring instruments. '),
(6, 'Stores Section', ''),
(7, 'Transportation Division ', 'Administration - Transportation,'),
(8, 'Finance Division', '');

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `name`, `epf_no`) VALUES
(6, 'admin', 'hpWtVcw_ls2heKPtEryiW2mnxjzDmqCJ', '$2y$13$fvpXojBqXGmBGG2v46QuGelMIczOiwHgm0ZGzSpnQ6Egs1SWnIvJK', NULL, 'admin@accmt.ac.lk', 10, 1439485843, 1439485843, 'System Admin', '1'),
(7, 'allaccess', 'ehdxr0H17Qq2TQBjVmJO3dNXXttfoKXM', '$2y$13$OtV.Wpw4k7tr/WsFiU3WyOeOLBMdn879wf0YeiXbprhP2Pelyx51K', NULL, 'allaccess@accmt.ac.lk', 10, 1439485921, 1439485921, 'All access', '2'),
(8, 'ddg', 'x934lEjrDE0AI2cDYGI60I25xHBCwBWT', '$2y$13$v3IWyIJPsQzHV/J/Fdw8PuwkgZ0Rv2Gxf4Z5yIetwnmYAK4SxntGi', NULL, 'ddg@accmt.ac.lk', 10, 1439537403, 1439537403, 'Deputy Director Genaral', '3'),
(9, 'dhit', 'QzYe4SPpBTwMNdUP4B8w4OboT_ubkMVY', '$2y$13$oacLlArcS/xRdpzc9l1aIeSwq8LWlld9s0ebQjnuN/Uvpn5Lb9M76', NULL, 'dhit@accmt.ac.lk', 10, 1439537482, 1439537482, 'Divisional Head IT', '4'),
(10, 'Engineer', 'KxVCio72MBDdJcWdFOlRlPueOLKroqoQ', '$2y$13$9OGK/GTlkzV/KTliHOAB5ecBGK5ntTeKSirnxdvowcx9/VaFt.Ipa', NULL, 'engineer@accmt.ac.lk', 10, 1439538008, 1439538255, 'Engineer Electronics & Microelectronics Division', '5'),
(11, 'shstores', '3nvkXODdEmdFTaxdHj08vxonuMG8MCb0', '$2y$13$BUiXzvcpP7/t0IPnuO2GkeYBwE.ZYuupUW0omI/BkaKXhm/jkCWqy', NULL, 'shstores@accmt.ac.lk', 10, 1439538322, 1439538322, 'Sectional Head Stores', '6'),
(12, 'ssstores', 'MakUHrRv6PKGyS1w9fkyagzQ9nDRQ5IF', '$2y$13$q5joQ2JmPIdDF.hdPp1e6.BpQnHOh/8fPdRhf.XBigSt/EFyNvB1q', NULL, 'ssstaff@accmt.ac.lk', 10, 1439538386, 1439538386, 'Sectional Staff Stores', '7');

 
INSERT INTO `division_has_user` (`division_id`, `user_id`) VALUES
(2, 6),
(1, 7),
(2, 7),
(3, 7),
(2, 9),
(1, 10),
(6, 11),
(6, 12);
 
INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('deputy-director-genaral', 7, NULL),
('deputy-director-genaral', 8, NULL),
('divisional-head', 7, NULL),
('divisional-head', 9, NULL),
('engineer', 7, NULL),
('engineer', 10, NULL),
('sectional-head', 7, NULL),
('sectional-head', 11, NULL),
('sectional-staff', 7, NULL),
('sectional-staff', 12, NULL),
('system-admin', 6, NULL),
('system-admin', 7, NULL);
 
INSERT INTO `project_type` (`id`, `name`, `description`) VALUES
(1, 'In-house Project', 'In-house Project'),
(2, 'Activity', 'Activity'),
(3, 'Client-based Project', 'Client-based Project'),
(4, 'Course', 'Course');

 INSERT INTO `project` (`id`, `name`, `code`, `client`, `state`, `description`, `parent_project_id`, `requested_user_id`, `approved_ddg_user_id`, `approved_dh_user_id`, `project_type_id`, `division_id`, `created_at`, `approval_date`, `quarterly_targets`, `team_leader`, `starting_date`, `end_date`) VALUES
(4, 'Project 1', 'p1', 'client 1', 'active', 'Description', NULL, 7, 7, 7, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Project 2', 'p2', 'client 2', 'active', 'Description', NULL, 7, 7, 7, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Project 1.1', 'p1.1', 'client 1', 'pending', 'Description', 4, 7, NULL, NULL, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Project 1.2', 'p1.2', 'client 1', 'pending', 'Description', 4, 7, NULL, NULL, 1, 3, NULL, NULL, 'Target 1', 7, NULL, NULL);

 


INSERT INTO `report` (`id`, `title`, `content`, `submit_date`, `project_id`, `division_id`, `requested_user_id`, `approved_user_id`, `file`) VALUES
(6, 'Requisition form 1', 'Content', '2015-08-14 01:08:48', 6, 6, 7, 7, NULL),
(7, 'Institute Description', '<p>The Arthur C Clarke Institute for Modern Technologies (ACCIMT) is a State Institution for Research &amp; Development and Training. The Institute specializes in the disciplines of Electronics, Micro-electronics, Telecommunications, Information Technology, Space Technologies, Robotics and other related fields of modern technologies. Established in its present corporate form as a Statutory Board by the Science and Technology Development Act No. 11 of 1994, the Institute is operating within the purview of the Ministry of Technology and Research</p>\r\n', '2015-08-15 01:08:38', 6, 2, 7, NULL, NULL);






