create database CasCofoniePasteTheo
use CasCofoniePasteTheo

create table Type_Institution(
	code_type_institution INT PRIMARY KEY NOT NULL IDENTITY(1,1),
	lib_type_unstitution char(20)
)



create table Institution(
	code_institution int primary key not null identity(1,1),
	nom_institution char(50),
	type_institution int Foreign key references Type_Institution(code_type_institution)
	)
	


create table Role(
	code_role int primary key not null identity(1,1),
	lib_role varchar(200),
	institution int foreign key references Institution(code_institution)
)

create table Organe(
	code_organe int primary key not null identity(1,1),
	lib_organe char(20),
	nbr_pers_organe int,
)

create table Comprendre(
	code_institution int foreign key references Institution(code_institution),
	code_organe int foreign key references Organe(code_organe)
	primary key(code_institution, code_organe)
)







create table Texte(
	code_texte int primary key not null identity(1,1),
	titre_texte char(50) not null,
	vote_final_texte int,
	promulgation_texte Date,
	code_institution int foreign key references Institution(code_institution)
)


create table Article(
	code_article int not null,
	titre_article char(50) not null,
	texte_article varchar(1000),
	code_texte int foreign key references Texte(code_texte),
	primary key(code_texte, code_article)
)


create table Faire_Reference(
	code_texte int,
	code_article int ,
	code_texte_ref int,
	code_article_ref int ,
	

	foreign key(code_texte,code_article) references Article(code_texte,code_article),
	foreign key (code_texte_ref, code_article_ref) references Article(code_texte, code_article),
	primary key(code_texte, code_article, code_texte_ref, code_article_ref)
)


create table Amendement(
	code_seq_amendement int not null,
	lib_amendement char(50) not null,
	texte_amendement varchar(1000) not null,
	date_amendement date,
	code_article_ref int not null,
	code_texte_ref  int not null,
	foreign key(code_texte_ref , code_article_ref ) references Article(code_texte, code_article),
	primary key(code_texte_ref , code_article_ref , code_seq_amendement)
)

create table Date(
	jour_vote date
	primary key(jour_vote)
)


create table Voter(
	nbr_voix_pour int,
	nbr_voix_contre int,

	date_vote date not null foreign key references Date(jour_vote),
	
	code_texte int not null,
	code_article int not null,
	foreign key(code_texte, code_article) references Article(code_texte, code_article),

	organe_vote int not null foreign key references Organe(code_organe),
	
	primary key(code_texte, code_article, organe_vote, date_vote)
)




create table Utilisateur(
	code_user int primary key identity(1,1),
	nom_user char(30),
	prenom_user char(30),
	login_user char(30),
	password_user char(10) not null,
	code_organe int,
	role_user char(20)

	foreign key(code_organe) references Organe(code_organe)
)




/*LES INSERT*/

insert into Utilisateur values('LeNom', 'LePrenom', 'login', 'login', 1)
insert into Utilisateur values('LePetit', 'Philipe', 'plepetit', 'plepetit',2)
insert into Utilisateur values('LeGrand', 'Bernard', 'blegrand', 'blegrand', 3)
insert into Utilisateur values('Lebrin', 'Maurice', 'mlebrin', 'mlebrin', 4)

insert into Type_Institution values ('Executif')
insert into Type_Institution values ('Législatif')
insert into Type_Institution values ('Judiciaire')


insert into Institution values('President', 1)
insert into Institution values('Gouvernement', 1)
insert into Institution values('Parlement', 2)
insert into Institution values('Conseil Constitutionnel', null)
insert into Institution values('Juge', 3)


insert into Role values('Dissoudre l Assemblée',1)
insert into Role values('Recourir au référendum',1)
insert into Role values('Promulguer les lois',1)
insert into Role values('Exercer les pleins pouvoirs en cas de crise',1)
insert into Role values('Négocier les traités',1)
insert into Role values('Définit et conduit la politique de la nation',2)
insert into Role values('Vote les lois dans le domaine énuméré par l article 34 de la constitution',3)
insert into Role values('Vérifie que les lois adoptées par le parlement respectent la constitution',4)
insert into Role values('Sanctionne les infractions à la loi',5)


insert into Texte values('Loi 1', null, null, 3)
insert into Texte values('Loi 2', null, null, 3)
insert into Texte values('Loi 3', null, null, 3)
insert into Texte values('Loi 4', null, null, 3)
insert into Texte values('Loi 5', null, null, 3)
insert into Texte values('Loi 6', null, null, 3)
insert into Texte values('Loi 7', null, null, 3)


insert into Article values(1,'Article 1','Texte de l article 1 du premier texte',1)
insert into Article values(2,'Article 2','Texte de l article 2 du premier texte',1)
insert into Article values(1,'Article 1','Texte de l article 1 du texte 2',2)
insert into Article values(2,'Article 2','Texte de l article 2 du texte 2',2)
insert into Article values(1,'Article 1','Texte de l article 1 du texte 3',3)
insert into Article values(1,'Article 1','Texte de l article 1 du texte 4',4)
insert into Article values(1,'Article 1','Texte de l article 1 du texte 5',5)
insert into Article values(1,'Article 1','Texte de l article 1 du texte 6',6)
insert into Article values(1,'Article 1','Texte de l article 1 du texte 7',7)

insert into Amendement values(1,'Amendement Article 2 Texte 1', 'La il y a les modif', GETDATE(), 2,1)
insert into Amendement values(2,'Amendement Article 2 Texte 1', 'Encore des modif', GETDATE(), 2,1)
insert into Amendement values(1,'Amendement Article 1 Texte 7', 'La il y a les modif', GETDATE(), 1,7)
insert into Amendement values(1,'Amendement Article 2 Texte 2', 'La il y a les modif', GETDATE(), 2,2)

insert into Organe values('Premier Ministre',1)
insert into Organe values('Ministres',19)
insert into Organe values('Assemblé Nationale',577)
insert into Organe values('Sénat',348)

insert into Comprendre values(2,1)
insert into Comprendre values(2,2)
insert into Comprendre values(3,3)
insert into Comprendre values(3,4)

insert into Date values(GETDATE())
insert into Date values('2020-05-21')
insert into Date values('2020-05-20')
insert into Date values('2020-05-19')
insert into Date values('2020-05-18')
insert into Date values('2020-05-17')
insert into Date values('2020-05-16')
insert into Date values('2020-05-15')
insert into Date values('2020-05-14')
insert into Date values('2020-05-13')
insert into Date values('2020-05-12')
insert into Date values('2020-05-11')
insert into Date values('2020-05-10')
insert into Date values('2020-05-09')
insert into Date values('2020-05-08')
insert into Date values('2020-05-07')
insert into Date values('2020-05-06')
insert into Date values('2020-05-05')
insert into Date values('2020-05-04')
insert into Date values('2020-05-03')
insert into Date values('2020-05-02')

insert into Voter values(40,30,'2020-05-04',1,1,3)
insert into Voter values(18,20,'2020-05-02',1,1,3)
insert into Voter values(23,12,'2020-05-02',1,1,4)
insert into Voter values(20,15,'2020-05-05',1,1,4)
insert into Voter values(48,10,'2020-05-10',1,2,3)
insert into Voter values(16,42,'2020-05-15',1,2,4)
insert into Voter values(50,12,'2020-05-05',7,1,3)

insert into Faire_Reference values(7,1,1,2)
insert into Faire_Reference values(7,1,1,1)
insert into Faire_Reference values(7,1,2,1)


select * from Amendement
select * from Article
select * from Comprendre
select * from Date
select * from Faire_Reference
select * from Institution
select * from Organe
select * from Role
select * from Texte
select * from Type_Institution
select * from Utilisateur
select * from Voter

delete from Texte where code_texte = 30

update Article 
set titre_article = 'Article 2 Loi 13'
where code_article = 2 and code_texte = 28

alter table Utilisateur add role_user char(20)

/*LES TRIGGER*/

CREATE TRIGGER triggerVoter 
   ON  Voter
   AFTER INSERT
AS 
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Un organe ne peut voter que 2 fois pour le meme article
	-- Un article ne peut être voter plus de 4 fois
	-- La date du vote ne peut être supérieur à la date d'aujourd'hui

	declare @nbvoteOrgane int;
	declare @nbvoteTotal int;
	declare @dateVote date;

	set @nbvoteOrgane = (SELECT count(*)
						FROM VOTER
						where Voter.organe_vote = (select organe_vote from inserted)
						and Voter.code_article = (select code_article from inserted)
						and Voter.code_texte = (select code_texte from inserted)
						and Voter.date_vote = (select date_vote from inserted));

	set @nbvoteTotal = (SELECT count(*)
						FROM VOTER
						where Voter.code_article = (select code_article from inserted)
						and Voter.code_texte = (select code_texte from inserted)
						and Voter.date_vote = (select date_vote from inserted));

	set @dateVote = (select date_vote from inserted);

	if(@nbvoteOrgane > 2 or @nbvoteTotal > 4 or GETDATE() < @dateVote)
	begin
		delete from Voter
		where Voter.organe_vote = (select organe_vote from inserted)
		and Voter.code_article = (select code_article from inserted)
		and Voter.code_texte = (select code_texte from inserted)
		and Voter.date_vote = (select date_vote from inserted)
		print 'Erreur, ce vote ne peut être pris en compte :'
		print 'Veuilez vérifier la date du vote ainsi que le nombre de votes de votre organe ou les votes totaux'
	end	

	-- fin

END




create trigger triggerOrgane
on Comprendre
after INSERT
as
begin
	-- Une institution ne peut contenir plus de 2 Organes
	declare @nbOrganeDansInstitution int;
	
	set @nbOrganeDansInstitution = (select count(*) from Comprendre where Comprendre.code_institution = (select code_institution from inserted));

	if(@nbOrganeDansInstitution > 2)
		delete from Comprendre
		where Comprendre.code_institution = (select code_institution from inserted)
		and Comprendre.code_organe = (select code_organe from inserted)
		print 'Erreur'
end





create trigger triggerTexte
on Texte
after Update
as
begin
	-- Une loi ne peut être promulgué que si tous les articles qui la composent ont des votes positifs des 2 organes
	declare cursorArticle cursor for (select Article.code_article, Article.code_texte from Article where Article.texte_article = (select code_texte from inserted))
	declare @codeArticle int
	declare @codeTexte int
	open cursorArticle
	fetch next from cursorArticle into @codeArticle, @codeTexte;

	declare @nbVotePour int 
	declare @nbVoteContre int

	declare @decision int
	set @decision = 1 -- Decision à 1 => ok		Décision à 0 => pas ok

	while @@FETCH_STATUS = 0
	begin
		declare cursorVoteArticle cursor for (select Voter.nbr_voix_pour, Voter.nbr_voix_contre from Voter where Voter.code_texte = @codeTexte and Voter.code_article = @codeArticle)
		open cursorVoteArticle
		fetch next from cursorVoteArticle into @nbVotePour, @nbVoteContre

		while @@FETCH_STATUS = 0
		begin
			if(@nbVotePour <= @nbVoteContre)
				set @decision = 0

			fetch next from cursorVoteArticle into @nbVotePour, @nbVoteContre
		end
		
		fetch next from cursorArticle into @codeArticle, @codeTexte
		close cursorArticle
	end

	if(@decision = 0)
		update Texte
		set Texte.promulgation_texte = 0
		where Texte.code_texte = (select code_texte from inserted)
end