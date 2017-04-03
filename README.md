Database
========

# Installation du projet:
-------------------------

### Récupérer le projet:
git clone https://github.com/MWJordanP/MysqlMongo.git

### Déplacez-vous dans la racine de projet:
cd MysqlMongo

### Lancer l'installation du projet avec:
composer install

# Utilisation:
--------------

Dans la console, placez vous à la racine du projet et lancez les commandes suivantes:
### Pour importer les acteurs
	sf database:import:actors

### Pour importer les films:
	sf database:import:movies


# Explication:
--------------

### Récupération des informations:
Dans le dossier src/AppBundle/Entity, il y a les définitions des classes des différentes tables que l'on récupère du Mysql du serveur.

Grâce à l'ORM Doctrine, on décrit dans chaque classes Entity, les relations entre les différentes tables de Mysql grâce à des annotations

	// Ici, on indique à Doctrine que la variable $castsInfos est un tableau de l'entitée CastInfo.
	// L'annotations 'mappedBy="name"' indique une relation entre les tables cast_info et name sur la colonne "person_id"
	/**
     * @var CastInfo[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CastInfo", mappedBy="name")
     * @ORM\JoinColumn(name="person_id")
     */
    protected $castsInfos;

Une fois toutes les Entity créées, Doctrine a la partie du schéma de la base de données Mysql selon ce que l'on a décrit dans les Entity.

### Création des entitées dans Mongo:
Dans le dossier src/MongoBundle/Document, il y a les définitions des classes des entitées que l'on créé dans Mongo.

### Import des acteurs
L'import des acteurs se fait dans le fichier ImportActorCommand.php dans le dossier /src/MongoBundle/Command/.

Dans la méthode import(), on va créer une connexion à la base Mysql et une connexion à la base MongoDb.

	// Connexion à Mysql
    $om = $this->getContainer()->get('doctrine')->getManager();
    $om->getConnection()->getConfiguration()->setSQLLogger(null);

    // Connexion à MongoDb
    $dm = $this->getContainer()->get('doctrine_mongodb')->getManager();

Ensuite, on récupère les informations dans la table Name de Mysql

    $names = $om->getRepository('AppBundle:Name')->findBy([], ['id' => 'ASC'], 1000);

La variable $names est un tableau des résultats de la requête faite sur les tables Name, PersonInfo, InfoType, CastInfo et Title.
La méthode findBy() prend en argument:
- Les critères de la clause WHERE sous forme de tableau (ex: array('nomChamp' => 'valeurVoulu')), ici on applique pas de critère
- Le tri souhaité dans la clause ORDER BY sous forme de tableau, dans notre cas on tri sur le champs Name.id par ordre croissant
- La limite de la clause LIMIT, ici on limite à 1000 ligne

Ensuite pour chaque ligne retournée par la requête:
- on créé un nouveau Document MongoDb
    $actor = new Actor();

- on assigne les valeurs récupérées de Mysql dans les champs MongoDb équivalants, par exemple:
    $actor->setName($name->getName());

    foreach ($name->getCastsInfos() as $castInfo) {
        $actor->addMovie($castInfo->getTitle()->getTitle());
    }

- persist() va signaler à Doctrine de préparer l'enregistrement du Document dans MongoDb
    $dm->persist($actor);

- flush() va lancer l'enregistrement des Document dans MongoDb
	$dm->flush();

### Import des films
L'import des films se fait dans le fichier ImportMovieCommand.php dans le dossier /src/MongoBundle/Command/.

La méthode import() exécute les mêmes étapes que celle d'import des acteurs, excepté aux niveaux des traitements de données, que l'on adapte aux informations récupérées dans Mysql et à insérer dans les Documents MongoDb.
