<?php

namespace Map;

use \Receipt;
use \ReceiptQuery;
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
 * This class defines the structure of the 'receipt' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ReceiptTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ReceiptTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'garantieapp';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'receipt';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Receipt';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Receipt';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the receipt_pk field
     */
    const COL_RECEIPT_PK = 'receipt.receipt_pk';

    /**
     * the column name for the dossier_fk field
     */
    const COL_DOSSIER_FK = 'receipt.dossier_fk';

    /**
     * the column name for the creation_date field
     */
    const COL_CREATION_DATE = 'receipt.creation_date';

    /**
     * the column name for the due_date field
     */
    const COL_DUE_DATE = 'receipt.due_date';

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
        self::TYPE_PHPNAME       => array('ReceiptPk', 'DossierFk', 'CreationDate', 'DueDate', ),
        self::TYPE_CAMELNAME     => array('receiptPk', 'dossierFk', 'creationDate', 'dueDate', ),
        self::TYPE_COLNAME       => array(ReceiptTableMap::COL_RECEIPT_PK, ReceiptTableMap::COL_DOSSIER_FK, ReceiptTableMap::COL_CREATION_DATE, ReceiptTableMap::COL_DUE_DATE, ),
        self::TYPE_FIELDNAME     => array('receipt_pk', 'dossier_fk', 'creation_date', 'due_date', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('ReceiptPk' => 0, 'DossierFk' => 1, 'CreationDate' => 2, 'DueDate' => 3, ),
        self::TYPE_CAMELNAME     => array('receiptPk' => 0, 'dossierFk' => 1, 'creationDate' => 2, 'dueDate' => 3, ),
        self::TYPE_COLNAME       => array(ReceiptTableMap::COL_RECEIPT_PK => 0, ReceiptTableMap::COL_DOSSIER_FK => 1, ReceiptTableMap::COL_CREATION_DATE => 2, ReceiptTableMap::COL_DUE_DATE => 3, ),
        self::TYPE_FIELDNAME     => array('receipt_pk' => 0, 'dossier_fk' => 1, 'creation_date' => 2, 'due_date' => 3, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
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
        $this->setName('receipt');
        $this->setPhpName('Receipt');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Receipt');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('receipt_receipt_pk_seq');
        // columns
        $this->addPrimaryKey('receipt_pk', 'ReceiptPk', 'INTEGER', true, null, null);
        $this->addForeignKey('dossier_fk', 'DossierFk', 'INTEGER', 'dossier', 'dossier_pk', true, null, null);
        $this->addColumn('creation_date', 'CreationDate', 'DATE', false, null, 'CURRENT_DATE');
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
), null, null, null, false);
    } // buildRelations()

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ReceiptPk', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ReceiptPk', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ReceiptPk', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ReceiptPk', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ReceiptPk', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ReceiptPk', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ReceiptPk', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ReceiptTableMap::CLASS_DEFAULT : ReceiptTableMap::OM_CLASS;
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
     * @return array           (Receipt object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ReceiptTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ReceiptTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ReceiptTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ReceiptTableMap::OM_CLASS;
            /** @var Receipt $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ReceiptTableMap::addInstanceToPool($obj, $key);
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
            $key = ReceiptTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ReceiptTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Receipt $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ReceiptTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ReceiptTableMap::COL_RECEIPT_PK);
            $criteria->addSelectColumn(ReceiptTableMap::COL_DOSSIER_FK);
            $criteria->addSelectColumn(ReceiptTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(ReceiptTableMap::COL_DUE_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.receipt_pk');
            $criteria->addSelectColumn($alias . '.dossier_fk');
            $criteria->addSelectColumn($alias . '.creation_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(ReceiptTableMap::DATABASE_NAME)->getTable(ReceiptTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ReceiptTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ReceiptTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ReceiptTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Receipt or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Receipt object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ReceiptTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Receipt) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ReceiptTableMap::DATABASE_NAME);
            $criteria->add(ReceiptTableMap::COL_RECEIPT_PK, (array) $values, Criteria::IN);
        }

        $query = ReceiptQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ReceiptTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ReceiptTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the receipt table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ReceiptQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Receipt or Criteria object.
     *
     * @param mixed               $criteria Criteria or Receipt object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReceiptTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Receipt object
        }

        if ($criteria->containsKey(ReceiptTableMap::COL_RECEIPT_PK) && $criteria->keyContainsValue(ReceiptTableMap::COL_RECEIPT_PK) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ReceiptTableMap::COL_RECEIPT_PK.')');
        }


        // Set the correct dbName
        $query = ReceiptQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ReceiptTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ReceiptTableMap::buildTableMap();
