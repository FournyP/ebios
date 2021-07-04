<?php

namespace App\Doctrine;

use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\QueryBuilder;
use App\Entity\Workshop5;
use App\Entity\Workshop4;
use App\Entity\Workshop3;
use App\Entity\Workshop2;
use App\Entity\Workshop1;
use App\Entity\User;
use App\Entity\SupportingAsset;
use App\Entity\StrategicScenario;
use App\Entity\StakeHolderCategory;
use App\Entity\StakeHolder;
use App\Entity\SecurityMeasure;
use App\Entity\SecurityBaseline;
use App\Entity\Risk;
use App\Entity\Project;
use App\Entity\Organization;
use App\Entity\OperationalScenario;
use App\Entity\Measure;
use App\Entity\Gap;
use App\Entity\FearedEvent;
use App\Entity\ColumnAction;
use App\Entity\BusinessAsset;
use App\Entity\Action;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;

class CurrentUserExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, ?string $operationName = null)
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, ?string $operationName = null, array $context = [])
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass)
    {
        $alias = $queryBuilder->getRootAliases()[0];

        /**
         * @var User
         */
        $user = $this->security->getUser();

        $userId = $user->getId();

        if ($resourceClass === Organization::class) {
            $this->addWhereForUser($queryBuilder, $alias, $userId);
        }

        if ($resourceClass === Project::class) {
            $this->addWhereForOrganization($queryBuilder, $alias, $userId);
        }

        if ($resourceClass === Workshop1::class || $resourceClass === Workshop2::class || $resourceClass === Workshop3::class || $resourceClass === Workshop4::class || $resourceClass === Workshop5::class) {
            $this->addWhereForProject($queryBuilder, $alias, $userId);
        }

        if ($resourceClass === BusinessAsset::class || $resourceClass === SecurityBaseline::class) {
            $this->addWhereForWorkshop1($queryBuilder, $alias, $userId);
        }

        if ($resourceClass === SupportingAsset::class || $resourceClass === FearedEvent::class) {
            $this->addWhereForBusinessAsset($queryBuilder, $alias, $userId);
        }

        if ($resourceClass === Gap::class) {
            $this->addWhereForSecurityBaseline($queryBuilder, $alias, $userId);
        }

        if ($resourceClass === Risk::class) {
            $this->addWhereForWorkshop2($queryBuilder, $alias, $userId);
        }

        if ($resourceClass === StakeHolderCategory::class || $resourceClass === StrategicScenario::class) {
            $this->addWhereForWorkshop3($queryBuilder, $alias, $userId);
        }

        if ($resourceClass === StakeHolder::class) {
            $this->addWhereForStakeHolderCategory($queryBuilder, $alias, $userId);
        }

        if ($resourceClass === SecurityMeasure::class) {
            $this->addWhereForStakeHolder($queryBuilder, $alias, $userId);
        }

        if ($resourceClass === OperationalScenario::class) {
            $this->addWhereForWorkshop4($queryBuilder, $alias, $userId);
        }

        if ($resourceClass === ColumnAction::class) {
            $this->addWhereForOperationalScenario($queryBuilder, $alias, $userId);
        }

        if ($resourceClass === Action::class) {
            $this->addWhereForColumnAction($queryBuilder, $alias, $userId);
        }

        if ($resourceClass === Measure::class) {
            $this->addWhereForWorkshop5($queryBuilder, $alias, $userId);
        }
    }

    private function addWhereForUser(QueryBuilder $queryBuilder, string $alias, int $userId) 
    {
        $queryBuilder->andWhere("$alias.user IN (:ids)")
            ->setParameter('ids', [$userId]);
    }

    private function addWhereForOrganization(QueryBuilder $queryBuilder, string $alias, int $userId) 
    {
        $newAlias = "orga";
        $queryBuilder->join("$alias.organization", $newAlias);
        $this->addWhereForUser($queryBuilder, $newAlias, $userId);
    }

    private function addWhereForProject(QueryBuilder $queryBuilder, string $alias, int $userId) 
    {
        $newAlias = "project";
        $queryBuilder->join("$alias.project", $newAlias);
        $this->addWhereForOrganization($queryBuilder, $newAlias, $userId);
    }

    private function addWhereForWorkshop1(QueryBuilder $queryBuilder, string $alias, int $userId) 
    {
        $newAlias = "work";
        $queryBuilder->join("$alias.workshop1", $newAlias);
        $this->addWhereForProject($queryBuilder, $newAlias, $userId);
    }

    private function addWhereForBusinessAsset(QueryBuilder $queryBuilder, string $alias, int $userId)
    {
        $newAlias = "business";
        $queryBuilder->join("$alias.businessAsset", $newAlias);
        $this->addWhereForWorkshop1($queryBuilder, $newAlias, $userId);
    }

    private function addWhereForSecurityBaseline(QueryBuilder $queryBuilder, string $alias, int $userId)
    {
        $newAlias = "security";
        $queryBuilder->join("$alias.securityBaseline", $newAlias);
        $this->addWhereForWorkshop1($queryBuilder, $newAlias, $userId);
    }

    private function addWhereForWorkshop2(QueryBuilder $queryBuilder, string $alias, int $userId) 
    {
        $newAlias = "work";
        $queryBuilder->join("$alias.workshop2", $newAlias);
        $this->addWhereForProject($queryBuilder, $newAlias, $userId);
    }

    private function addWhereForWorkshop3(QueryBuilder $queryBuilder, string $alias, int $userId)
    {
        $newAlias = "work";
        $queryBuilder->join("$alias.workshop3", $newAlias);
        $this->addWhereForProject($queryBuilder, $newAlias, $userId);
    }

    private function addWhereForStakeHolderCategory(QueryBuilder $queryBuilder, string $alias, int $userId)
    {
        $newAlias = "stakeHolderCategory";
        $queryBuilder->join("$alias.stakeHolderCategory", $newAlias);
        $this->addWhereForWorkshop3($queryBuilder, $newAlias, $userId);
    }

    private function addWhereForStakeHolder(QueryBuilder $queryBuilder, string $alias, int $userId)
    {
        $newAlias = "stakeHolder";
        $queryBuilder->join("$alias.stakeHolder", $newAlias);
        $this->addWhereForStakeHolderCategory($queryBuilder, $newAlias, $userId);
    }

    private function addWhereForWorkshop4(QueryBuilder $queryBuilder, string $alias, int $userId) 
    {
        $newAlias = "work";
        $queryBuilder->join("$alias.workshop4", $newAlias);
        $this->addWhereForProject($queryBuilder, $newAlias, $userId);
    }

    private function addWhereForOperationalScenario(QueryBuilder $queryBuilder, string $alias, int $userId)
    {
        $newAlias = "operationalScenario";
        $queryBuilder->join("$alias.operationalScenario", $newAlias);
        $this->addWhereForWorkshop4($queryBuilder, $newAlias, $userId);
    }

    private function addWhereForColumnAction(QueryBuilder $queryBuilder, string $alias, int $userId)
    {
        $newAlias = "columnAction";
        $queryBuilder->join("$alias.columnAction", $newAlias);
        $this->addWhereForOperationalScenario($queryBuilder, $newAlias, $userId);
    }

    private function addWhereForWorkshop5(QueryBuilder $queryBuilder, string $alias, int $userId)
    {
        $newAlias = "work";
        $queryBuilder->join("$alias.workshop5", $newAlias);
        $this->addWhereForProject($queryBuilder, $newAlias, $userId);
    }
} 