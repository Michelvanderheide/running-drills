<?php

namespace Map;

use \Product;
use \ProductQuery;
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
 * This class defines the structure of the 'product' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ProductTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ProductTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'garantieapp';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'product';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Product';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Product';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the product_pk field
     */
    const COL_PRODUCT_PK = 'product.product_pk';

    /**
     * the column name for the dossier_fk field
     */
    const COL_DOSSIER_FK = 'product.dossier_fk';

    /**
     * the column name for the store_fk field
     */
    const COL_STORE_FK = 'product.store_fk';

    /**
     * the column name for the store_chain_fk field
     */
    const COL_STORE_CHAIN_FK = 'product.store_chain_fk';

    /**
     * the column name for the creation_date field
     */
    const COL_CREATION_DATE = 'product.creation_date';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'product.name';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'product.description';

    /**
     * the column name for the price field
     */
    const COL_PRICE = 'product.price';

    /**
     * the column name for the purchase_date field
     */
    const COL_PURCHASE_DATE = 'product.purchase_date';

    /**
     * the column name for the due_date field
     */
    const COL_DUE_DATE = 'product.due_date';

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
        self::TYPE_PHPNAME       => array('ProductPk', 'DossierFk', 'StoreFk', 'StoreChainFk', 'CreationDate', 'Name', 'Description', 'Price', 'PurchaseDate', 'DueDate', ),
        self::TYPE_CAMELNAME     => array('productPk', 'dossierFk', 'storeFk', 'storeChainFk', 'creationDate', 'name', 'description', 'price', 'purchaseDate', 'dueDate', ),
        self::TYPE_COLNAME       => array(ProductTableMap::COL_PRODUCT_PK, ProductTableMap::COL_DOSSIER_FK, ProductTableMap::COL_STORE_FK, ProductTableMap::COL_STORE_CHAIN_FK, ProductTableMap::COL_CREATION_DATE, ProductTableMap::COL_NAME, ProductTableMap::COL_DESCRIPTION, ProductTableMap::COL_PRICE, ProductTableMap::COL_PURCHASE_DATE, ProductTableMap::COL_DUE_DATE, ),
        self::TYPE_FIELDNAME     => array('product_pk', 'dossier_fk', 'store_fk', 'store_chain_fk', 'creation_date', 'name', 'description', 'price', 'purchase_date', 'due_date', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('ProductPk' => 0, 'DossierFk' => 1, 'StoreFk' => 2, 'StoreChainFk' => 3, 'CreationDate' => 4, 'Name' => 5, 'Description' => 6, 'Price' => 7, 'PurchaseDate' => 8, 'DueDate' => 9, ),
        self::TYPE_CAMELNAME     => array('productPk' => 0, 'dossierFk' => 1, 'storeFk' => 2, 'storeChainFk' => 3, 'creationDate' => 4, 'name' => 5, 'description' => 6, 'price' => 7, 'purchaseDate' => 8, 'dueDate' => 9, ),
        self::TYPE_COLNAME       => array(ProductTableMap::COL_PRODUCT_PK => 0, ProductTableMap::COL_DOSSIER_FK => 1, ProductTableMap::COL_STORE_FK => 2, ProductTableMap::COL_STORE_CHAIN_FK => 3, ProductTableMap::COL_CREATION_DATE => 4, ProductTableMap::COL_NAME => 5, ProductTableMap::COL_DESCRIPTION => 6, ProductTableMap::COL_PRICE => 7, ProductTableMap::COL_PURCHASE_DATE => 8, ProductTableMap::COL_DUE_DATE => 9, ),
        self::TYPE_FIELDNAME     => array('product_pk' => 0, 'dossier_fk' => 1, 'store_fk' => 2, 'store_chain_fk' => 3, 'creation_date' => 4, 'name' => 5, 'description' => 6, 'price' => 7, 'purchase_date' => 8, 'due_date' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $this->setName('product');
        $this->setPhpName('Product');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Product');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('product_product_pk_seq');
        // columns
        $this->addPrimaryKey('product_pk', 'ProductPk', 'INTEGER', true, null, null);
        $this->addForeignKey('dossier_fk', 'DossierFk', 'INTEGER', 'dossier', 'dossier_pk', true, null, null);
        $this->addForeignKey('store_fk', 'StoreFk', 'INTEGER', 'store', 'store_pk', false, null, null);
        $this->addForeignKey('store_chain_fk', 'StoreChainFk', 'INTEGER', 'store_chain', 'store_chain_pk', false, null, null);
        $this->addColumn('creation_date', 'CreationDate', 'DATE', false, null, 'CURRENT_DATE');
        $this->addColumn('name', 'Name', 'VARCHAR', false, null, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, null, null);
        $this->addColumn('price', 'Price', 'NUMERIC', false, null, null);
        $this->addColumn('purchase_date', 'PurchaseDate', 'DATE', false, null, null);
        $this->addColumn('due_date', 'DueDate', 'DATE', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Dossier', '\\Dossier', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':dossier_fk',
    1 => ':dossier_pk',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Store', '\\Store', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':store_fk',
    1 => ':store_pk',
  ),
), null, null, null, false);
        $this->addRelation('StoreChain', '\\StoreChain', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':store_chain_fk',
    1 => ':store_chain_pk',
  ),
), null, null, null, false);
        $this->addRelation('ProductComment', '\\ProductComment', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_fk',
    1 => ':product_pk',
  ),
), 'CASCADE', null, 'ProductComments', false);
        $this->addRelation('OcrTask', '\\OcrTask', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_fk',
    1 => ':product_pk',
  ),
), 'CASCADE', null, 'OcrTasks', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to product     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        ProductCommentTableMap::clearInstancePool();
        OcrTaskTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductPk', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductPk', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductPk', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductPk', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductPk', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductPk', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ProductPk', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ProductTableMap::CLASS_DEFAULT : ProductTableMap::OM_CLASS;
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
     * @return array           (Product object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ProductTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProductTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProductTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProductTableMap::OM_CLASS;
            /** @var Product $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProductTableMap::addInstanceToPool($obj, $key);
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
            $key = ProductTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProductTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Product $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProductTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_PK);
            $criteria->addSelectColumn(ProductTableMap::COL_DOSSIER_FK);
            $criteria->addSelectColumn(ProductTableMap::COL_STORE_FK);
            $criteria->addSelectColumn(ProductTableMap::COL_STORE_CHAIN_FK);
            $criteria->addSelectColumn(ProductTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(ProductTableMap::COL_NAME);
            $criteria->addSelectColumn(ProductTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(ProductTableMap::COL_PRICE);
            $criteria->addSelectColumn(ProductTableMap::COL_PURCHASE_DATE);
            $criteria->addSelectColumn(ProductTableMap::COL_DUE_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.product_pk');
            $criteria->addSelectColumn($alias . '.dossier_fk');
            $criteria->addSelectColumn($alias . '.store_fk');
            $criteria->addSelectColumn($alias . '.store_chain_fk');
            $criteria->addSelectColumn($alias . '.creation_date');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.purchase_date');
            $criteria->addSelectColumn($alias . '.due_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(ProductTableMap::DATABASE_NAME)->getTable(ProductTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ProductTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ProductTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ProductTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Product or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Product object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Product) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProductTableMap::DATABASE_NAME);
            $criteria->add(ProductTableMap::COL_PRODUCT_PK, (array) $values, Criteria::IN);
        }

        $query = ProductQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProductTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProductTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ProductQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Product or Criteria object.
     *
     * @param mixed               $criteria Criteria or Product object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Product object
        }

        if ($criteria->containsKey(ProductTableMap::COL_PRODUCT_PK) && $criteria->keyContainsValue(ProductTableMap::COL_PRODUCT_PK) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProductTableMap::COL_PRODUCT_PK.')');
        }


        // Set the correct dbName
        $query = ProductQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ProductTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ProductTableMap::buildTableMap();
