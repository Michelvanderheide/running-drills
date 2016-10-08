<?php

namespace Map;

use \OcrTask;
use \OcrTaskQuery;
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
 * This class defines the structure of the 'ocr_task' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class OcrTaskTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.OcrTaskTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'garantieapp';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'ocr_task';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\OcrTask';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'OcrTask';

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
     * the column name for the ocr_task_pk field
     */
    const COL_OCR_TASK_PK = 'ocr_task.ocr_task_pk';

    /**
     * the column name for the product_fk field
     */
    const COL_PRODUCT_FK = 'ocr_task.product_fk';

    /**
     * the column name for the ocr_task_status_fk field
     */
    const COL_OCR_TASK_STATUS_FK = 'ocr_task.ocr_task_status_fk';

    /**
     * the column name for the task_id field
     */
    const COL_TASK_ID = 'ocr_task.task_id';

    /**
     * the column name for the creation_time field
     */
    const COL_CREATION_TIME = 'ocr_task.creation_time';

    /**
     * the column name for the start_time field
     */
    const COL_START_TIME = 'ocr_task.start_time';

    /**
     * the column name for the start_counter field
     */
    const COL_START_COUNTER = 'ocr_task.start_counter';

    /**
     * the column name for the source_file_path field
     */
    const COL_SOURCE_FILE_PATH = 'ocr_task.source_file_path';

    /**
     * the column name for the parsed_text field
     */
    const COL_PARSED_TEXT = 'ocr_task.parsed_text';

    /**
     * the column name for the status_message field
     */
    const COL_STATUS_MESSAGE = 'ocr_task.status_message';

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
        self::TYPE_PHPNAME       => array('OcrTaskPk', 'ProductFk', 'OcrTaskStatusFk', 'TaskId', 'CreationTime', 'StartTime', 'StartCounter', 'SourceFilePath', 'ParsedText', 'StatusMessage', ),
        self::TYPE_CAMELNAME     => array('ocrTaskPk', 'productFk', 'ocrTaskStatusFk', 'taskId', 'creationTime', 'startTime', 'startCounter', 'sourceFilePath', 'parsedText', 'statusMessage', ),
        self::TYPE_COLNAME       => array(OcrTaskTableMap::COL_OCR_TASK_PK, OcrTaskTableMap::COL_PRODUCT_FK, OcrTaskTableMap::COL_OCR_TASK_STATUS_FK, OcrTaskTableMap::COL_TASK_ID, OcrTaskTableMap::COL_CREATION_TIME, OcrTaskTableMap::COL_START_TIME, OcrTaskTableMap::COL_START_COUNTER, OcrTaskTableMap::COL_SOURCE_FILE_PATH, OcrTaskTableMap::COL_PARSED_TEXT, OcrTaskTableMap::COL_STATUS_MESSAGE, ),
        self::TYPE_FIELDNAME     => array('ocr_task_pk', 'product_fk', 'ocr_task_status_fk', 'task_id', 'creation_time', 'start_time', 'start_counter', 'source_file_path', 'parsed_text', 'status_message', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('OcrTaskPk' => 0, 'ProductFk' => 1, 'OcrTaskStatusFk' => 2, 'TaskId' => 3, 'CreationTime' => 4, 'StartTime' => 5, 'StartCounter' => 6, 'SourceFilePath' => 7, 'ParsedText' => 8, 'StatusMessage' => 9, ),
        self::TYPE_CAMELNAME     => array('ocrTaskPk' => 0, 'productFk' => 1, 'ocrTaskStatusFk' => 2, 'taskId' => 3, 'creationTime' => 4, 'startTime' => 5, 'startCounter' => 6, 'sourceFilePath' => 7, 'parsedText' => 8, 'statusMessage' => 9, ),
        self::TYPE_COLNAME       => array(OcrTaskTableMap::COL_OCR_TASK_PK => 0, OcrTaskTableMap::COL_PRODUCT_FK => 1, OcrTaskTableMap::COL_OCR_TASK_STATUS_FK => 2, OcrTaskTableMap::COL_TASK_ID => 3, OcrTaskTableMap::COL_CREATION_TIME => 4, OcrTaskTableMap::COL_START_TIME => 5, OcrTaskTableMap::COL_START_COUNTER => 6, OcrTaskTableMap::COL_SOURCE_FILE_PATH => 7, OcrTaskTableMap::COL_PARSED_TEXT => 8, OcrTaskTableMap::COL_STATUS_MESSAGE => 9, ),
        self::TYPE_FIELDNAME     => array('ocr_task_pk' => 0, 'product_fk' => 1, 'ocr_task_status_fk' => 2, 'task_id' => 3, 'creation_time' => 4, 'start_time' => 5, 'start_counter' => 6, 'source_file_path' => 7, 'parsed_text' => 8, 'status_message' => 9, ),
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
        $this->setName('ocr_task');
        $this->setPhpName('OcrTask');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\OcrTask');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('ocr_task_ocr_task_pk_seq');
        // columns
        $this->addPrimaryKey('ocr_task_pk', 'OcrTaskPk', 'INTEGER', true, null, null);
        $this->addForeignKey('product_fk', 'ProductFk', 'INTEGER', 'product', 'product_pk', true, null, null);
        $this->addForeignKey('ocr_task_status_fk', 'OcrTaskStatusFk', 'INTEGER', 'ocr_task_status', 'ocr_task_status_pk', true, null, 1);
        $this->addColumn('task_id', 'TaskId', 'VARCHAR', false, null, null);
        $this->addColumn('creation_time', 'CreationTime', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('start_time', 'StartTime', 'TIMESTAMP', false, null, null);
        $this->addColumn('start_counter', 'StartCounter', 'INTEGER', false, null, null);
        $this->addColumn('source_file_path', 'SourceFilePath', 'VARCHAR', false, null, null);
        $this->addColumn('parsed_text', 'ParsedText', 'VARCHAR', false, null, null);
        $this->addColumn('status_message', 'StatusMessage', 'VARCHAR', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Product', '\\Product', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':product_fk',
    1 => ':product_pk',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('OcrTaskStatus', '\\OcrTaskStatus', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ocr_task_status_fk',
    1 => ':ocr_task_status_pk',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OcrTaskPk', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OcrTaskPk', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OcrTaskPk', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OcrTaskPk', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OcrTaskPk', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OcrTaskPk', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OcrTaskPk', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OcrTaskTableMap::CLASS_DEFAULT : OcrTaskTableMap::OM_CLASS;
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
     * @return array           (OcrTask object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = OcrTaskTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OcrTaskTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OcrTaskTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OcrTaskTableMap::OM_CLASS;
            /** @var OcrTask $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OcrTaskTableMap::addInstanceToPool($obj, $key);
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
            $key = OcrTaskTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OcrTaskTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OcrTask $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OcrTaskTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OcrTaskTableMap::COL_OCR_TASK_PK);
            $criteria->addSelectColumn(OcrTaskTableMap::COL_PRODUCT_FK);
            $criteria->addSelectColumn(OcrTaskTableMap::COL_OCR_TASK_STATUS_FK);
            $criteria->addSelectColumn(OcrTaskTableMap::COL_TASK_ID);
            $criteria->addSelectColumn(OcrTaskTableMap::COL_CREATION_TIME);
            $criteria->addSelectColumn(OcrTaskTableMap::COL_START_TIME);
            $criteria->addSelectColumn(OcrTaskTableMap::COL_START_COUNTER);
            $criteria->addSelectColumn(OcrTaskTableMap::COL_SOURCE_FILE_PATH);
            $criteria->addSelectColumn(OcrTaskTableMap::COL_PARSED_TEXT);
            $criteria->addSelectColumn(OcrTaskTableMap::COL_STATUS_MESSAGE);
        } else {
            $criteria->addSelectColumn($alias . '.ocr_task_pk');
            $criteria->addSelectColumn($alias . '.product_fk');
            $criteria->addSelectColumn($alias . '.ocr_task_status_fk');
            $criteria->addSelectColumn($alias . '.task_id');
            $criteria->addSelectColumn($alias . '.creation_time');
            $criteria->addSelectColumn($alias . '.start_time');
            $criteria->addSelectColumn($alias . '.start_counter');
            $criteria->addSelectColumn($alias . '.source_file_path');
            $criteria->addSelectColumn($alias . '.parsed_text');
            $criteria->addSelectColumn($alias . '.status_message');
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
        return Propel::getServiceContainer()->getDatabaseMap(OcrTaskTableMap::DATABASE_NAME)->getTable(OcrTaskTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(OcrTaskTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(OcrTaskTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new OcrTaskTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a OcrTask or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or OcrTask object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OcrTaskTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \OcrTask) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OcrTaskTableMap::DATABASE_NAME);
            $criteria->add(OcrTaskTableMap::COL_OCR_TASK_PK, (array) $values, Criteria::IN);
        }

        $query = OcrTaskQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OcrTaskTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OcrTaskTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ocr_task table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return OcrTaskQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OcrTask or Criteria object.
     *
     * @param mixed               $criteria Criteria or OcrTask object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OcrTaskTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OcrTask object
        }

        if ($criteria->containsKey(OcrTaskTableMap::COL_OCR_TASK_PK) && $criteria->keyContainsValue(OcrTaskTableMap::COL_OCR_TASK_PK) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OcrTaskTableMap::COL_OCR_TASK_PK.')');
        }


        // Set the correct dbName
        $query = OcrTaskQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // OcrTaskTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
OcrTaskTableMap::buildTableMap();
