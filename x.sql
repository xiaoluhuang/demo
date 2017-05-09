drop TABLE `user` ;
CREATE TABLE `user` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `username` varchar(50) NOT NULL comment '用户昵称',
      `is_email_verified` tinyint(1) NOT NULL DEFAULT '0' comment '是否邮箱认证',
      `email` varchar(50) NOT NULL comment '邮箱',
      `avatar` varchar(100) DEFAULT 'default.jpg' COMMENT '头像图片地址',
      `role_id` int(6) NOT NULL comment '角色id',
      `status` tinyint(1) NOT NULL DEFAULT '1' comment '状态: 0新建，1正常，2冻结',
      `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间' ,
      `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
      PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8  comment='用户表';
