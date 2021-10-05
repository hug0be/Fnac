/*==============================================================*/
/* Nom de SGBD :  PostgreSQL 8                                  */
/* 
*/
/*==============================================================*/


drop table if exists T_E_ADRESSE_ADR cascade;

drop table if exists T_E_AVIS_AVI cascade;

drop table if exists T_E_CLIENT_CLI cascade;

drop table if exists T_E_COMMANDE_COM cascade;

drop table if exists T_E_JEUVIDEO_JEU cascade;

drop table if exists T_E_MOTCLE_MOT cascade;

drop table if exists T_E_PHOTO_PHO cascade;

drop table if exists T_E_RELAIS_REL cascade;

drop table if exists T_E_VIDEO_VID cascade;

drop table if exists T_J_ALERTE_ALE cascade;

drop table if exists T_J_AVISABUSIF_AVA cascade;

drop table if exists T_J_FAVORI_FAV cascade;

drop table if exists T_J_GENREJEU_GEJ cascade;

drop table if exists T_J_JEURAYON_JER cascade;

drop table if exists T_J_LIGNECOMMANDE_LEC cascade;

drop table if exists T_J_RELAISCLIENT_REC cascade;

drop table if exists T_R_CONSOLE_CON cascade;

drop table if exists T_R_EDITEUR_EDI cascade;

drop table if exists T_R_GENRE_GEN cascade;

drop table if exists T_R_MAGASIN_MAG cascade;

drop table if exists T_R_PAYS_PAY cascade;

drop table if exists T_R_RAYON_RAY cascade;

/*==============================================================*/
/* Table : T_E_ADRESSE_ADR                                      */
/*==============================================================*/
create table T_E_ADRESSE_ADR (
   ADR_ID               SERIAL               not null,
   CLI_ID               INT4                 not null,
   ADR_NOM              VARCHAR(50)          not null,
   ADR_TYPE             VARCHAR(15)          not null
      constraint CKC_ADR_TYPE check (ADR_TYPE in ('Livraison','Facturation')),
   ADR_RUE              VARCHAR(200)         not null,
   ADR_COMPLEMENTRUE    VARCHAR(200)         null,
   ADR_CP               VARCHAR(10)          not null,
   ADR_VILLE            VARCHAR(100)         not null,
   PAY_ID               INT4                 not null,
   ADR_LATITUDE         FLOAT8               null,
   ADR_LONGITUDE        FLOAT8               null,
   constraint PK_ADR primary key (ADR_ID)
);

/*==============================================================*/
/* Table : T_E_AVIS_AVI                                         */
/*==============================================================*/
create table T_E_AVIS_AVI (
   AVI_ID               SERIAL               not null,
   CLI_ID               INT4                 not null,
   JEU_ID               INT4                 not null,
   AVI_DATE             DATE                 not null default CURRENT_DATE,
   AVI_TITRE            VARCHAR(100)         not null,
   AVI_DETAIL           VARCHAR(2000)        not null,
   AVI_NOTE             INT2                 not null
      constraint CK_AVI_NOTE check (AVI_NOTE between 1 and 5),
   AVI_NBUTILEOUI       INT2                 not null
      constraint CK_AVI_NBUTILEOUI check (AVI_NBUTILEOUI >= 0),
   AVI_NBUTILENON       INT2                 not null
      constraint CK_AVI_NBUTILENON check (AVI_NBUTILENON >= 0),
   constraint PK_AVI primary key (AVI_ID)
);

/*==============================================================*/
/* Table : T_E_CLIENT_CLI                                       */
/*==============================================================*/
create table T_E_CLIENT_CLI (
   CLI_ID               SERIAL               not null,
   CLI_MEL              VARCHAR(80)          not null
   	  constraint UQ_CLI_MEL unique,
   CLI_MOTPASSE         VARCHAR(128)          not null,
   CLI_PSEUDO           VARCHAR(20)          not null,
   CLI_CIVILITE         VARCHAR(4)           not null
      constraint CK_CLI_CIVILITE check (CLI_CIVILITE in ('M.','Mlle','Mme')),
   CLI_NOM              VARCHAR(50)          not null,
   CLI_PRENOM           VARCHAR(50)          not null,
   CLI_TELFIXE          VARCHAR(15)          null,
   CLI_TELPORTABLE      VARCHAR(15)          null,
   MAG_ID				INT4,
   constraint PK_CLI primary key (CLI_ID),
   constraint  CK_CLI_FIXE_PORTABLE check ((CLI_TELFIXE is null AND CLI_TELPORTABLE is not null) OR (CLI_TELFIXE is not null AND CLI_TELPORTABLE is null) OR (CLI_TELFIXE is not null AND CLI_TELPORTABLE is not null))
);

/*==============================================================*/
/* Table : T_E_COMMANDE_COM                                     */
/*==============================================================*/
create table T_E_COMMANDE_COM (
   COM_ID               SERIAL               not null,
   CLI_ID               INT4                 not null,
   REL_ID               INT4                 null,
   ADR_ID               INT4                 null,
   MAG_ID               INT4                 null,
   COM_DATE             DATE                 not null,
   constraint PK_COM primary key (COM_ID),
   constraint CK_COM_REL_ADR check ((REL_ID is null and MAG_ID is null and ADR_ID is not null) OR (REL_ID is not null and MAG_ID is null and ADR_ID is null) OR (REL_ID is null and MAG_ID is not null and ADR_ID is null))
);

/*==============================================================*/
/* Table : T_E_JEUVIDEO_JEU                                     */
/*==============================================================*/
create table T_E_JEUVIDEO_JEU (
   JEU_ID               SERIAL               not null,
   EDI_ID               INT4                 not null,
   CON_ID               INT4                 not null,
   JEU_NOM              VARCHAR(100)         not null,
   JEU_DESCRIPTION      VARCHAR(500)         null,
   JEU_DATEPARUTION     DATE                 not null,
   JEU_PRIXTTC          NUMERIC(5,2)         not null,
   JEU_CODEBARRE        VARCHAR(13)          not null,
   JEU_PUBLICLEGAL      VARCHAR(3)           null
      constraint CK_JEU_PUBLICLEGAL check (JEU_PUBLICLEGAL is null or (JEU_PUBLICLEGAL in ('18+','16+','12+','7+','3+'))),
   JEU_STOCK            INT4                 not null
   	  constraint CK_JEU_STOCK check (JEU_STOCK >=0),
   constraint PK_JEU primary key (JEU_ID)
);

/*==============================================================*/
/* Table : T_E_MOTCLE_MOT                                       */
/*==============================================================*/
create table T_E_MOTCLE_MOT (
   MOT_ID               SERIAL               not null,
   JEU_ID               INT4                 not null,
   MOT_MOT              VARCHAR(30)          not null,
   constraint PK_MOT primary key (MOT_ID)
);

/*==============================================================*/
/* Table : T_E_PHOTO_PHO                                        */
/*==============================================================*/
create table T_E_PHOTO_PHO (
   PHO_ID               SERIAL               not null,
   JEU_ID               INT4                 not null,
   PHO_URL              VARCHAR(200)         not null,
   constraint PK_PHO primary key (PHO_ID)
);

/*==============================================================*/
/* Table : T_E_RELAIS_REL                                       */
/*==============================================================*/
create table T_E_RELAIS_REL (
   REL_ID               SERIAL               not null,
   REL_NOM              VARCHAR(100)         not null,
   REL_RUE              VARCHAR(200)         not null,
   REL_CP               VARCHAR(10)          not null,
   REL_VILLE            VARCHAR(100)         not null,
   PAY_ID               INT4                 not null,
   REL_LATITUDE         FLOAT8               null,
   REL_LONGITUDE        FLOAT8               null,
   constraint PK_REL primary key (REL_ID)
);

/*==============================================================*/
/* Table : T_E_VIDEO_VID                                        */
/*==============================================================*/
create table T_E_VIDEO_VID (
   VID_ID               SERIAL               not null,
   JEU_ID               INT4                 not null,
   VID_URL              VARCHAR(200)         not null,
   constraint PK_VID primary key (VID_ID)
);

/*==============================================================*/
/* Table : T_J_ALERTE_ALE                                       */
/*==============================================================*/
create table T_J_ALERTE_ALE (
   CLI_ID               INT4                 not null,
   JEU_ID               INT4                 not null,
   constraint PK_ALE primary key (CLI_ID, JEU_ID)
);

/*==============================================================*/
/* Table : T_J_AVISABUSIF_AVA                                   */
/*==============================================================*/
create table T_J_AVISABUSIF_AVA (
   CLI_ID               INT4                 not null,
   AVI_ID               INT4                 not null,
   constraint PK_AVA primary key (CLI_ID, AVI_ID)
);

/*==============================================================*/
/* Table : T_J_FAVORI_FAV                                       */
/*==============================================================*/
create table T_J_FAVORI_FAV (
   CLI_ID               INT4                 not null,
   JEU_ID               INT4                 not null,
   constraint PK_FAV primary key (CLI_ID, JEU_ID)
);

/*==============================================================*/
/* Table : T_J_GENREJEU_GEJ                                     */
/*==============================================================*/
create table T_J_GENREJEU_GEJ (
   JEU_ID               INT4                 not null,
   GEN_ID               INT4                 not null,
   constraint PK_GEJ primary key (JEU_ID, GEN_ID)
);

/*==============================================================*/
/* Table : T_J_JEURAYON_JER                                     */
/*==============================================================*/
create table T_J_JEURAYON_JER (
   JEU_ID               INT4                 not null,
   RAY_ID               INT4                 not null,
   constraint PK_JER primary key (JEU_ID, RAY_ID)
);

/*==============================================================*/
/* Table : T_J_LIGNECOMMANDE_LEC                                */
/*==============================================================*/
create table T_J_LIGNECOMMANDE_LEC (
   COM_ID               INT4                 not null,
   JEU_ID               INT4                 not null,
   LEC_QUANTITE         INT4                 not null
   	  constraint CK_LEC_QUANTITE check (LEC_QUANTITE >=1),
   constraint PK_LEC primary key (COM_ID, JEU_ID)
);

/*==============================================================*/
/* Table : T_J_RELAISCLIENT_REC                                 */
/*==============================================================*/
create table T_J_RELAISCLIENT_REC (
   CLI_ID               INT4                 not null,
   REL_ID               INT4                 not null,
   constraint PK_REC primary key (CLI_ID, REL_ID)
);

/*==============================================================*/
/* Table : T_R_CONSOLE_CON                                      */
/*==============================================================*/
create table T_R_CONSOLE_CON (
   CON_ID               SERIAL               not null,
   CON_NOM              VARCHAR(30)          not null,
   constraint PK_CON primary key (CON_ID)
);

/*==============================================================*/
/* Table : T_R_EDITEUR_EDI                                      */
/*==============================================================*/
create table T_R_EDITEUR_EDI (
   EDI_ID               SERIAL               not null,
   EDI_NOM              VARCHAR(100)         not null,
   constraint PK_EDI primary key (EDI_ID)
);

/*==============================================================*/
/* Table : T_R_GENRE_GEN                                        */
/*==============================================================*/
create table T_R_GENRE_GEN (
   GEN_ID               SERIAL               not null,
   GEN_LIBELLE          VARCHAR(50)          not null,
   constraint PK_GEN primary key (GEN_ID)
);

/*==============================================================*/
/* Table : T_R_MAGASIN_MAG                                      */
/*==============================================================*/
create table T_R_MAGASIN_MAG (
   MAG_ID               SERIAL               not null,
   MAG_NOM              VARCHAR(100)         not null,
   MAG_VILLE            VARCHAR(100)         not null,
   constraint PK_T_R_MAGASIN_MAG primary key (MAG_ID)
);

/*==============================================================*/
/* Table : T_R_PAYS_PAY                                         */
/*==============================================================*/
create table T_R_PAYS_PAY (
   PAY_ID               SERIAL               not null,
   PAY_NOM              VARCHAR(50)          not null,
   constraint PK_PAY primary key (PAY_ID)
);

/*==============================================================*/
/* Table : T_R_RAYON_RAY                                        */
/*==============================================================*/
create table T_R_RAYON_RAY (
   RAY_ID               SERIAL               not null,
   RAY_NOM              VARCHAR(50)          not null,
   constraint PK_RAY primary key (RAY_ID)
);

alter table T_E_ADRESSE_ADR
   add constraint FK_ADR_CLI foreign key (CLI_ID)
      references T_E_CLIENT_CLI (CLI_ID)
      on delete restrict on update restrict;

alter table T_E_ADRESSE_ADR
   add constraint FK_ADR_PAY foreign key (PAY_ID)
      references T_R_PAYS_PAY (PAY_ID)
      on delete restrict on update restrict;

alter table T_E_AVIS_AVI
   add constraint FK_AVI_CLI foreign key (CLI_ID)
      references T_E_CLIENT_CLI (CLI_ID)
      on delete restrict on update restrict;

alter table T_E_AVIS_AVI
   add constraint FK_AVI_JEU foreign key (JEU_ID)
      references T_E_JEUVIDEO_JEU (JEU_ID)
      on delete restrict on update restrict;
      
alter table T_E_CLIENT_CLI
   add constraint FK_CLI_MAG foreign key (MAG_ID)
      references T_R_MAGASIN_MAG (MAG_ID)
      on delete restrict on update restrict;

alter table T_E_COMMANDE_COM
   add constraint FK_COM_REL foreign key (REL_ID)
      references T_E_RELAIS_REL (REL_ID)
      on delete restrict on update restrict;

alter table T_E_COMMANDE_COM
   add constraint FK_COM_ADR foreign key (ADR_ID)
      references T_E_ADRESSE_ADR (ADR_ID)
      on delete restrict on update restrict;

alter table T_E_COMMANDE_COM
   add constraint FK_COM_CLI foreign key (CLI_ID)
      references T_E_CLIENT_CLI (CLI_ID)
      on delete restrict on update restrict;

alter table T_E_COMMANDE_COM
   add constraint FK_COM_MAG foreign key (MAG_ID)
      references T_R_MAGASIN_MAG (MAG_ID)
      on delete restrict on update restrict;

alter table T_E_JEUVIDEO_JEU
   add constraint FK_JEU_CON foreign key (CON_ID)
      references T_R_CONSOLE_CON (CON_ID)
      on delete restrict on update restrict;

alter table T_E_JEUVIDEO_JEU
   add constraint FK_JEU_EDI foreign key (EDI_ID)
      references T_R_EDITEUR_EDI (EDI_ID)
      on delete restrict on update restrict;

alter table T_E_MOTCLE_MOT
   add constraint FK_MOT_JEU foreign key (JEU_ID)
      references T_E_JEUVIDEO_JEU (JEU_ID)
      on delete restrict on update restrict;

alter table T_E_PHOTO_PHO
   add constraint FK_PHO_JEU foreign key (JEU_ID)
      references T_E_JEUVIDEO_JEU (JEU_ID)
      on delete restrict on update restrict;

alter table T_E_RELAIS_REL
   add constraint FK_REL_PAY foreign key (PAY_ID)
      references T_R_PAYS_PAY (PAY_ID)
      on delete restrict on update restrict;

alter table T_E_VIDEO_VID
   add constraint FK_VID_JEU foreign key (JEU_ID)
      references T_E_JEUVIDEO_JEU (JEU_ID)
      on delete restrict on update restrict;

alter table T_J_ALERTE_ALE
   add constraint FK_ALE_CLI foreign key (CLI_ID)
      references T_E_CLIENT_CLI (CLI_ID)
      on delete restrict on update restrict;

alter table T_J_ALERTE_ALE
   add constraint FK_ALE_JEU foreign key (JEU_ID)
      references T_E_JEUVIDEO_JEU (JEU_ID)
      on delete restrict on update restrict;

alter table T_J_AVISABUSIF_AVA
   add constraint FK_AVA_AVI foreign key (AVI_ID)
      references T_E_AVIS_AVI (AVI_ID)
      on delete restrict on update restrict;

alter table T_J_AVISABUSIF_AVA
   add constraint FK_AVA_CLI foreign key (CLI_ID)
      references T_E_CLIENT_CLI (CLI_ID)
      on delete restrict on update restrict;

alter table T_J_FAVORI_FAV
   add constraint FK_FAV_CLI foreign key (CLI_ID)
      references T_E_CLIENT_CLI (CLI_ID)
      on delete restrict on update restrict;

alter table T_J_FAVORI_FAV
   add constraint FK_FAV_JEU foreign key (JEU_ID)
      references T_E_JEUVIDEO_JEU (JEU_ID)
      on delete restrict on update restrict;

alter table T_J_GENREJEU_GEJ
   add constraint FK_GEJ_JEU foreign key (JEU_ID)
      references T_E_JEUVIDEO_JEU (JEU_ID)
      on delete restrict on update restrict;

alter table T_J_GENREJEU_GEJ
   add constraint FK_GEJ_GEN foreign key (GEN_ID)
      references T_R_GENRE_GEN (GEN_ID)
      on delete restrict on update restrict;

alter table T_J_JEURAYON_JER
   add constraint FK_JER_JEU foreign key (JEU_ID)
      references T_E_JEUVIDEO_JEU (JEU_ID)
      on delete restrict on update restrict;

alter table T_J_JEURAYON_JER
   add constraint FK_JER_RAY foreign key (RAY_ID)
      references T_R_RAYON_RAY (RAY_ID)
      on delete restrict on update restrict;

alter table T_J_LIGNECOMMANDE_LEC
   add constraint FK_LEC_COM foreign key (COM_ID)
      references T_E_COMMANDE_COM (COM_ID)
      on delete restrict on update restrict;

alter table T_J_LIGNECOMMANDE_LEC
   add constraint FK_LEC_JEU foreign key (JEU_ID)
      references T_E_JEUVIDEO_JEU (JEU_ID)
      on delete restrict on update restrict;

alter table T_J_RELAISCLIENT_REC
   add constraint FK_REC_REL foreign key (REL_ID)
      references T_E_RELAIS_REL (REL_ID)
      on delete restrict on update restrict;

alter table T_J_RELAISCLIENT_REC
   add constraint FK_REC_CLI foreign key (CLI_ID)
      references T_E_CLIENT_CLI (CLI_ID)
      on delete restrict on update restrict;
      

-- INSERT
INSERT INTO T_R_PAYS_PAY (PAY_NOM) VALUES ('France');
INSERT INTO T_R_PAYS_PAY (PAY_NOM) VALUES ('Suisse');
INSERT INTO T_R_PAYS_PAY (PAY_NOM) VALUES ('Italie');
INSERT INTO T_R_PAYS_PAY (PAY_NOM) VALUES ('Espagne');
INSERT INTO T_R_PAYS_PAY (PAY_NOM) VALUES ('UK');

INSERT INTO T_R_MAGASIN_MAG (MAG_NOM, MAG_VILLE) VALUES ('Annecy','Annecy');
INSERT INTO T_R_MAGASIN_MAG (MAG_NOM, MAG_VILLE) VALUES ('Chambéry','Chambéry');
INSERT INTO T_R_MAGASIN_MAG (MAG_NOM, MAG_VILLE) VALUES ('Lyon Bellecour','Lyon');
INSERT INTO T_R_MAGASIN_MAG (MAG_NOM, MAG_VILLE) VALUES ('Lyon Part-Dieu','Lyon');

INSERT INTO T_E_CLIENT_CLI (CLI_MEL, CLI_MOTPASSE, CLI_PSEUDO, CLI_CIVILITE, CLI_NOM, CLI_PRENOM, CLI_TELFIXE, CLI_TELPORTABLE, MAG_ID) VALUES ('paul.durand@gmail.com', '123', 'paulo', 'M.', 'DURAND', 'Paul', '0450505050', null, 1);
INSERT INTO T_E_CLIENT_CLI (CLI_MEL, CLI_MOTPASSE, CLI_PSEUDO, CLI_CIVILITE, CLI_NOM, CLI_PRENOM, CLI_TELFIXE, CLI_TELPORTABLE, MAG_ID) VALUES ('marc.dupond@gmail.com', '123', 'marco', 'M.', 'DUPOND', 'Marc', '0450505051', '0601010101', 4);
INSERT INTO T_E_CLIENT_CLI (CLI_MEL, CLI_MOTPASSE, CLI_PSEUDO, CLI_CIVILITE, CLI_NOM, CLI_PRENOM, CLI_TELFIXE, CLI_TELPORTABLE, MAG_ID) VALUES ('pascal.poison@gmail.com', '123', 'curare', 'M.', 'POISON', 'Pascal', '0450505052', '0601010102', 3);
INSERT INTO T_E_CLIENT_CLI (CLI_MEL, CLI_MOTPASSE, CLI_PSEUDO, CLI_CIVILITE, CLI_NOM, CLI_PRENOM, CLI_TELFIXE, CLI_TELPORTABLE, MAG_ID) VALUES ('vincent.vivant@gmail.com', '123', 'vince', 'M.', 'VIVANT', 'Vincent', '0450505051', '0601010101', 1);

INSERT INTO T_E_ADRESSE_ADR (CLI_ID, ADR_NOM, ADR_TYPE, ADR_RUE, ADR_CP, ADR_VILLE, PAY_ID, ADR_LATITUDE, ADR_LONGITUDE) VALUES (1, 'Chez moi', 'Facturation', 'Chemin de Bellevue', '74940', 'Annecy-le-Vieux', 1, 45.921154, 6.153794);
INSERT INTO T_E_ADRESSE_ADR (CLI_ID, ADR_NOM, ADR_TYPE, ADR_RUE, ADR_CP, ADR_VILLE, PAY_ID, ADR_LATITUDE, ADR_LONGITUDE) VALUES (1, 'Chez moi', 'Livraison', '9 rue de l''Arc en Ciel', '74940', 'Annecy-le-Vieux', 1, 45.919787, 6.160215 );
INSERT INTO T_E_ADRESSE_ADR (CLI_ID, ADR_NOM, ADR_TYPE, ADR_RUE, ADR_CP, ADR_VILLE, PAY_ID, ADR_LATITUDE, ADR_LONGITUDE) VALUES (2, 'Lyon', 'Facturation', '10 rue des 3 Rois', '69007', 'Lyon', 1, 45.753979, 4.842775);
INSERT INTO T_E_ADRESSE_ADR (CLI_ID, ADR_NOM, ADR_TYPE, ADR_RUE, ADR_CP, ADR_VILLE, PAY_ID, ADR_LATITUDE, ADR_LONGITUDE) VALUES (3, 'Villeurbanne', 'Facturation', '43 Boulevard du 11 Novembre 1918', '69100', 'Villeurbanne', 1, 45.779122, 4.864483);
INSERT INTO T_E_ADRESSE_ADR (CLI_ID, ADR_NOM, ADR_TYPE, ADR_RUE, ADR_CP, ADR_VILLE, PAY_ID, ADR_LATITUDE, ADR_LONGITUDE) VALUES (4, 'Annecy', 'Facturation', 'Rue de la gare', '74000', 'Annecy', 1, 45.900870, 6.121609);

INSERT INTO T_E_RELAIS_REL (REL_NOM, REL_RUE, REL_CP, REL_VILLE, PAY_ID, REL_LATITUDE, REL_LONGITUDE) VALUES ('Tabac presse des pommaries', '12 Rue des Pommaries', '74940', 'Annecy-le-Vieux', 1, 45.910793, 6.145592);
INSERT INTO T_E_RELAIS_REL (REL_NOM, REL_RUE, REL_CP, REL_VILLE, PAY_ID, REL_LATITUDE, REL_LONGITUDE) VALUES ('Casino', '7 Place du 18 Juin', '74940', 'Annecy-le-Vieux', 1, 45.915350, 6.145780);
INSERT INTO T_E_RELAIS_REL (REL_NOM, REL_RUE, REL_CP, REL_VILLE, PAY_ID, REL_LATITUDE, REL_LONGITUDE) VALUES ('Casino', '119 Rue Sébastien Gryphe', '69007', 'Lyon', 1, 45.748600, 4.839746);
INSERT INTO T_E_RELAIS_REL (REL_NOM, REL_RUE, REL_CP, REL_VILLE, PAY_ID, REL_LATITUDE, REL_LONGITUDE) VALUES ('Torrefaction des 3 Rois', '13 rue des 3 Rois', '69007', 'Lyon', 1, 45.753979, 4.842775);

INSERT INTO T_J_RELAISCLIENT_REC (CLI_ID, REL_ID) VALUES (1,1);
INSERT INTO T_J_RELAISCLIENT_REC (CLI_ID, REL_ID) VALUES (1,2);
   
INSERT INTO T_R_RAYON_RAY (RAY_NOM) VALUES ('Nouveautés');
INSERT INTO T_R_RAYON_RAY (RAY_NOM) VALUES ('Précommandes');
INSERT INTO T_R_RAYON_RAY (RAY_NOM) VALUES ('Les incontournables');
INSERT INTO T_R_RAYON_RAY (RAY_NOM) VALUES ('Meilleurs ventes');
INSERT INTO T_R_RAYON_RAY (RAY_NOM) VALUES ('Bonnes affaires');
INSERT INTO T_R_RAYON_RAY (RAY_NOM) VALUES ('Occasions');

INSERT INTO T_R_EDITEUR_EDI (EDI_NOM) VALUES ('Konami');
INSERT INTO T_R_EDITEUR_EDI (EDI_NOM) VALUES ('Sony');
INSERT INTO T_R_EDITEUR_EDI (EDI_NOM) VALUES ('Universal');
INSERT INTO T_R_EDITEUR_EDI (EDI_NOM) VALUES ('Electronic Arts');

INSERT INTO T_R_CONSOLE_CON (CON_NOM) VALUES ('Playstation 4');
INSERT INTO T_R_CONSOLE_CON (CON_NOM) VALUES ('Playstation 3');
INSERT INTO T_R_CONSOLE_CON (CON_NOM) VALUES ('Wii U');
INSERT INTO T_R_CONSOLE_CON (CON_NOM) VALUES ('PS Vita');
INSERT INTO T_R_CONSOLE_CON (CON_NOM) VALUES ('Xbox 360');
INSERT INTO T_R_CONSOLE_CON (CON_NOM) VALUES ('DS');

INSERT INTO T_R_GENRE_GEN (GEN_LIBELLE) VALUES ('Simulation');
INSERT INTO T_R_GENRE_GEN (GEN_LIBELLE) VALUES ('Action');
INSERT INTO T_R_GENRE_GEN (GEN_LIBELLE) VALUES ('Aventure');
INSERT INTO T_R_GENRE_GEN (GEN_LIBELLE) VALUES ('Sport');

INSERT INTO T_E_JEUVIDEO_JEU (EDI_ID, CON_ID, JEU_NOM, JEU_DESCRIPTION, JEU_DATEPARUTION, JEU_PRIXTTC, JEU_CODEBARRE, JEU_PUBLICLEGAL, JEU_STOCK)
VALUES (1, 1, 'Metal Gear Solid 5 :The Phantom Pain Day One Edition PS4', 'Le fameux studio de développement Kojima Productions revient avec le dernier chapitre de la saga METAL GEAR SOLID pour une expérience ultime au travers de METAL GEAR SOLID V: The Phantom Pain. Propulsant dans une nouvelle Ëre la franchise gr‚ce au "Fox Engine", le nouveau moteur de pointe développé en interne, MGSV: The Phantom Pain offrira aux joueurs une expérience de jeu unique gr‚ce aux concepts de liberté tactique et de missions en Mondes Ouverts.', to_date('01/09/2021', 'DD/MM/YYYY'), 49.99, '1234567891011', '18+', 10);
INSERT INTO T_E_JEUVIDEO_JEU (EDI_ID, CON_ID, JEU_NOM, JEU_DESCRIPTION, JEU_DATEPARUTION, JEU_PRIXTTC, JEU_CODEBARRE, JEU_PUBLICLEGAL, JEU_STOCK)
VALUES (1, 3, 'Metal Gear Solid 5 :The Phantom Pain Day One Edition Wii U', 'Le fameux studio de développement Kojima Productions revient avec le dernier chapitre de la saga METAL GEAR SOLID pour une expérience ultime au travers de METAL GEAR SOLID V: The Phantom Pain. Propulsant dans une nouvelle Ëre la franchise gr‚ce au "Fox Engine", le nouveau moteur de pointe développé en interne, MGSV: The Phantom Pain offrira aux joueurs une expérience de jeu unique gr‚ce aux concepts de liberté tactique et de missions en Mondes Ouverts.', to_date('01/09/2015', 'DD/MM/YYYY'), 49.99, '1234567891012', '18+', 20);
INSERT INTO T_E_JEUVIDEO_JEU (EDI_ID, CON_ID, JEU_NOM, JEU_DESCRIPTION, JEU_DATEPARUTION, JEU_PRIXTTC, JEU_CODEBARRE, JEU_PUBLICLEGAL, JEU_STOCK)
VALUES (2, 1, 'Until Dawn PS4', null, to_date('26/08/2015', 'DD/MM/YYYY'), 59.90, '1234567891013', '18+', 15);
INSERT INTO T_E_JEUVIDEO_JEU (EDI_ID, CON_ID, JEU_NOM, JEU_DESCRIPTION, JEU_DATEPARUTION, JEU_PRIXTTC, JEU_CODEBARRE, JEU_PUBLICLEGAL, JEU_STOCK)
VALUES (4, 1, 'FIFA 16 PS4', 'FIFA 16 innove sur tout le terrain pour proposer une expérience de jeu équilibrée, réaliste et passionnante qui vous permet de jouer comme vous voulez et au plus haut niveau. Découvrez de nouvelles façons de jouer !', to_date('24/09/2015', 'DD/MM/YYYY'), 59.99, '1234567891014', null, 0);

INSERT INTO T_E_MOTCLE_MOT (JEU_ID, MOT_MOT) VALUES (1, 'Mort');
INSERT INTO T_E_MOTCLE_MOT (JEU_ID, MOT_MOT) VALUES (1, 'Guerre');
INSERT INTO T_E_MOTCLE_MOT (JEU_ID, MOT_MOT) VALUES (1, 'Kalach');
INSERT INTO T_E_MOTCLE_MOT (JEU_ID, MOT_MOT) VALUES (3, 'Guerre');
INSERT INTO T_E_MOTCLE_MOT (JEU_ID, MOT_MOT) VALUES (4, 'Messi');
INSERT INTO T_E_MOTCLE_MOT (JEU_ID, MOT_MOT) VALUES (4, 'Foot');
INSERT INTO T_E_MOTCLE_MOT (JEU_ID, MOT_MOT) VALUES (4, 'Ronaldo');

INSERT INTO T_J_GENREJEU_GEJ (JEU_ID, GEN_ID) VALUES (1, 2);
INSERT INTO T_J_GENREJEU_GEJ (JEU_ID, GEN_ID) VALUES (1, 3);
INSERT INTO T_J_GENREJEU_GEJ (JEU_ID, GEN_ID) VALUES (2, 2);
INSERT INTO T_J_GENREJEU_GEJ (JEU_ID, GEN_ID) VALUES (2, 3);
INSERT INTO T_J_GENREJEU_GEJ (JEU_ID, GEN_ID) VALUES (3, 2);
INSERT INTO T_J_GENREJEU_GEJ (JEU_ID, GEN_ID) VALUES (4, 1);
INSERT INTO T_J_GENREJEU_GEJ (JEU_ID, GEN_ID) VALUES (4, 4);

INSERT INTO T_J_JEURAYON_JER (JEU_ID, RAY_ID) VALUES (1, 1);
INSERT INTO T_J_JEURAYON_JER (JEU_ID, RAY_ID) VALUES (1, 3);
INSERT INTO T_J_JEURAYON_JER (JEU_ID, RAY_ID) VALUES (1, 4);
INSERT INTO T_J_JEURAYON_JER (JEU_ID, RAY_ID) VALUES (2, 1);
INSERT INTO T_J_JEURAYON_JER (JEU_ID, RAY_ID) VALUES (4, 3);
INSERT INTO T_J_JEURAYON_JER (JEU_ID, RAY_ID) VALUES (4, 4);

INSERT INTO T_E_AVIS_AVI (CLI_ID, JEU_ID, AVI_TITRE, AVI_DETAIL, AVI_NOTE, AVI_NBUTILEOUI, AVI_NBUTILENON) VALUES (1, 1, 'Super', 'J''adore. Je recommande vivement son achat', 5, 0, 4);
INSERT INTO T_E_AVIS_AVI (CLI_ID, JEU_ID, AVI_TITRE, AVI_DETAIL, AVI_NOTE, AVI_NBUTILEOUI, AVI_NBUTILENON) VALUES (2, 1, 'Un peu cher', 'Super, mais un peu cher quand mÍme', 3, 3, 0);
INSERT INTO T_E_AVIS_AVI (CLI_ID, JEU_ID, AVI_TITRE, AVI_DETAIL, AVI_NOTE, AVI_NBUTILEOUI, AVI_NBUTILENON) VALUES (3, 1, 'Moyen', 'Pas mal, mais je préférais la version précédente', 2, 1, 1);

INSERT INTO T_E_COMMANDE_COM (REL_ID, ADR_ID, MAG_ID, CLI_ID, COM_DATE) VALUES (1, null, null, 1, current_date-20);
INSERT INTO T_E_COMMANDE_COM (REL_ID, ADR_ID, MAG_ID, CLI_ID, COM_DATE) VALUES (null, 2, null, 1, current_date-10);
INSERT INTO T_E_COMMANDE_COM (REL_ID, ADR_ID, MAG_ID, CLI_ID, COM_DATE) VALUES (null, null, 1, 1, current_date);

INSERT INTO T_J_LIGNECOMMANDE_LEC (COM_ID, JEU_ID, LEC_QUANTITE) VALUES (1, 1, 1);
INSERT INTO T_J_LIGNECOMMANDE_LEC (COM_ID, JEU_ID, LEC_QUANTITE) VALUES (1, 2, 3);
INSERT INTO T_J_LIGNECOMMANDE_LEC (COM_ID, JEU_ID, LEC_QUANTITE) VALUES (1, 3, 1);
INSERT INTO T_J_LIGNECOMMANDE_LEC (COM_ID, JEU_ID, LEC_QUANTITE) VALUES (2, 1, 1);
INSERT INTO T_J_LIGNECOMMANDE_LEC (COM_ID, JEU_ID, LEC_QUANTITE) VALUES (2, 2, 1);
INSERT INTO T_J_LIGNECOMMANDE_LEC (COM_ID, JEU_ID, LEC_QUANTITE) VALUES (2, 3, 1);
INSERT INTO T_J_LIGNECOMMANDE_LEC (COM_ID, JEU_ID, LEC_QUANTITE) VALUES (2, 4, 1);
INSERT INTO T_J_LIGNECOMMANDE_LEC (COM_ID, JEU_ID, LEC_QUANTITE) VALUES (3, 3, 10);

