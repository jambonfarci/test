# Réalisation

## Installation

`composer install`  
`symfony server:start`

## Commentaires

Je n'ai pas géré la persistence des données. Elles n'existent donc que dans le scope dans lequel elles sont utilisées.  
L'utilisation de la session aurait ici été judicieuse.

Afin d'ajouter facilement une nouvelle marque au système, il suffit juste de créer une nouvelle classe concrète qui  
étend la classe abstraite "Brand" et qui implémente l'interface "ShippingStrategyInterface". De cette manière, il sera  
facile pour chaque marque d'avoir des règles de gestion complètement différentes.

Le système utilisant la classe abstraite "Brand" pourrait être appliqué sous cette forme lors de la mise en place  
d'une base de donnée utilisant Doctrine : https://martinfowler.com/eaaCatalog/singleTableInheritance.html.

J'ai considéré que le taux de TVA était lié au pays de la marque et donc fait uniquement comme cela. Si ce calcul est  
complètement différent en fonction de chaque marque, il est possible de passer sur un système d'interface de la même  
manière que pour les frais de port.

Concernant les promotions, le cas d'utilisation n'étant pas clair pour moi, j'ai considéré qu'une promotion s'appliquait  
à un produit. De plus, un système de "Rule" similaire à celui de "Brand" est implémenté, ce qui permet d'être flexible  
par rapport aux conditions d'application d'une promotion. L'idée sous-jacente est de pouvoir réutiliser ce système de  
"Rule" à d'autres entité business. Ce n'est cependant pas tout à fait applicable en l'état car la fonction abstraite  
est liée à une entité "Item".

# TEST

Ceci est le repository pour le test technique de Farmitoo.

## Le cas

L'objectif est d'afficher une page "panier" sur laquelle sont visibles :
- tous les produits avec titre, prix unitaire, marque et quantité
- sous-total HT
- promotion (le cas échéant)
- frais de port HT
- total HT
- TVA
- Total TTC
- un bouton pour aller sur la page de paiement

#### Info TVA
Le business modèle de Farmitoo implique des règles de calculs de la TVA complexes.
Dans notre cas, il est simplifié et le taux de TVA dépend seulement de la marque du produit :
- Farmitoo => 20%
- Gallagher => 5%

#### Info frais de port
Les partenaires de Farmitoo ont des règles de calculs de frais de port très différentes. 
Voici celles de notre cas :
- Farmitoo : 20€ par tranche de 3 produits entamée (ex: 20€ pour 3 produits et 40€ pour 4 produits)
- Gallagher : 15€ quelque soit le nombre de produits

## L'évaluation
Il faut penser ton code comme évolutif :
- ajout de 10 nouvelles marques avec des nouvelles règles de calculs de TVA et de calculs de frais de port
- prise en compte du pays dans le calcul de la TVA
- nouvelles conditions d'application des promotions (nombre de produits, date, nombre d'utilisation...)

Au niveau global, sera évalué :
- la qualité du code
- la rigueur

#### Front
- L'UX
- L'organisation du code

#### Back
- Les choix de conception
- L'organisation du code

#### Test
L'objectif n'est pas un code coverage de 100% ! 
Mais un choix judicieux des choses à tester.
