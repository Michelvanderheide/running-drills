<?php

namespace Map;

use \StoreChain;
use \StoreChainQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'store_chain' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class StoreChainTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.StoreChainTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'runningdrills';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'store_chain';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\StoreChain';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'StoreChain';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the store_chain_pk field
     */
    const COL_STORE_CHAIN_PK = 'store_chain.store_chain_pk';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'store_chain.name';

    /**
     * the column name for the phone field
     */
    const COL_PHONE = 'store_chain.phone';

    /**
     * the column name for the website field
     */
    const COL_WEBSITE = 'store_chain.website';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'store_chain.email';

    /**
     * the column name for the img_url field
     */
    const COL_IMG_URL = 'store_chain.img_url';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('StoreChainPk', 'Name', 'Phone', 'Website', 'Email', 'ImgUrl', ),
        self::TYPE_CAMELNAME     => array('storeChainPk', 'name', 'phone', 'website', 'email', 'imgUrl', ),
        self::TYPE_COLNAME       => array(StoreChainTableMap::COL_STORE_CHAIN_PK, StoreChainTableMap::COL_NAME, StoreChainTableMap::COL_PHONE, StoreChainTableMap::COL_WEBSITE, StoreChainTableMap::COL_EMAIL, StoreChainTableMap::COL_IMG_URL, ),
        self::TYPE_FIELDNAME     => array('store_chain_pk', 'name', 'phone', 'website', 'email', 'img_url', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('StoreChainPk' => 0, 'Name' => 1, 'Phone' => 2, 'Website' => 3, 'Email' => 4, 'ImgUrl' => 5, ),
        self::TYPE_CAMELNAME     => array('storeChainPk' => 0, 'name' => 1, 'phone' => 2, 'website' => 3, 'email' => 4, 'imgUrl' => 5, ),
        self::TYPE_COLNAME       => array(StoreChainTableMap::COL_STORE_CHAIN_PK => 0, StoreChainTableMap::COL_NAME => 1, StoreChainTableMap::COL_PHONE => 2, StoreChainTableMap::COL_WEBSITE => 3, StoreChainTableMap::COL_EMAIL => 4, StoreChainTableMap::COL_IMG_URL => 5, ),
        self::TYPE_FIELDNAME     => array('store_chain_pk' => 0, 'name' => 1, 'phone' => 2, 'website' => 3, 'email' => 4, 'img_url' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('store_chain');
        $this->setPhpName('StoreChain');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\StoreChain');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('store_chain_store_chain_pk_seq');
        // columns
        $this->addPrimaryKey('store_chain_pk', 'StoreChainPk', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, null, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, null, null);
        $this->addColumn('website', 'Website', 'VARCHAR', false, null, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, null, null);
        $this->addColumn('img_url', 'ImgUrl', 'VARCHAR', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Store', '\\Store', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':store_chain_fk',
    1 => ':store_chain_pk',
  ),
), 'CASCADE', null, 'Stores', false);
        $this->addRelation('Product', '\\Product', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':store_chain_fk',
    1 => ':store_chain_pk',
  ),
), null, null, 'Products', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to store_chain     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        StoreTableMap::clearInstancePool();
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StoreChainPk', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StoreChainPk', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StoreChainPk', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StoreChainPk', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StoreChainPk', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StoreChainPk', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('StoreChainPk', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? StoreChainTableMap::CLASS_DEFAULT : StoreChainTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (StoreChain object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = StoreChainTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = StoreChainTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + StoreChainTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = StoreChainTableMap::OM_CLASS;
            /** @var StoreChain $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            StoreChainTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = StoreChainTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = StoreChainTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var StoreChain $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                StoreChainTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(StoreChainTableMap::COL_STORE_CHAIN_PK);
            $criteria->addSelectColumn(StoreChainTableMap::COL_NAME);
            $criteria->addSelectColumn(StoreChainTableMap::COL_PHONE);
            $criteria->addSelectColumn(StoreChainTableMap::COL_WEBSITE);
            $criteria->addSelectColumn(StoreChainTableMap::COL_EMAIL);
            $criteria->addSelectColumn(StoreChainTableMap::COL_IMG_URL);
        } else {
            $criteria->addSelectColumn($alias . '.store_chain_pk');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.website');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.img_url');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(StoreChainTableMap::DATABASE_NAME)->getTable(StoreChainTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(StoreChainTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(StoreChainTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new StoreChainTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a StoreChain or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or StoreChain object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StoreChainTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \StoreChain) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(StoreChainTableMap::DATABASE_NAME);
            $criteria->add(StoreChainTableMap::COL_STORE_CHAIN_PK, (array) $values, Criteria::IN);
        }

        $query = StoreChainQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            StoreChainTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                StoreChainTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the store_chain table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return StoreChainQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a StoreChain or Criteria object.
     *
     * @param mixed               $criteria Criteria or StoreChain object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StoreChainTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from StoreChain object
        }

        if ($criteria->containsKey(StoreChainTableMap::COL_STORE_CHAIN_PK) && $criteria->keyContainsValue(StoreChainTableMap::COL_STORE_CHAIN_PK) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.StoreChainTableMap::COL_STORE_CHAIN_PK.')');
        }


        // Set the correct dbName
        $query = StoreChainQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // StoreChainTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
StoreChainTableMap::buildTableMap();
