<?php

namespace Base;

use \OcrTaskQuery as ChildOcrTaskQuery;
use \OcrTaskStatus as ChildOcrTaskStatus;
use \OcrTaskStatusQuery as ChildOcrTaskStatusQuery;
use \Product as ChildProduct;
use \ProductQuery as ChildProductQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\OcrTaskTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'ocr_task' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class OcrTask implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\OcrTaskTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the ocr_task_pk field.
     *
     * @var        int
     */
    protected $ocr_task_pk;

    /**
     * The value for the product_fk field.
     *
     * @var        int
     */
    protected $product_fk;

    /**
     * The value for the ocr_task_status_fk field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $ocr_task_status_fk;

    /**
     * The value for the task_id field.
     *
     * @var        string
     */
    protected $task_id;

    /**
     * The value for the creation_time field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $creation_time;

    /**
     * The value for the start_time field.
     *
     * @var        DateTime
     */
    protected $start_time;

    /**
     * The value for the start_counter field.
     *
     * @var        int
     */
    protected $start_counter;

    /**
     * The value for the source_file_path field.
     *
     * @var        string
     */
    protected $source_file_path;

    /**
     * The value for the parsed_text field.
     *
     * @var        string
     */
    protected $parsed_text;

    /**
     * The value for the status_message field.
     *
     * @var        string
     */
    protected $status_message;

    /**
     * @var        ChildProduct
     */
    protected $aProduct;

    /**
     * @var        ChildOcrTaskStatus
     */
    protected $aOcrTaskStatus;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->ocr_task_status_fk = 1;
    }

    /**
     * Initializes internal state of Base\OcrTask object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>OcrTask</code> instance.  If
     * <code>obj</code> is an instance of <code>OcrTask</code>, delegates to
     * <code>equals(OcrTask)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|OcrTask The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [ocr_task_pk] column value.
     *
     * @return int
     */
    public function getOcrTaskPk()
    {
        return $this->ocr_task_pk;
    }

    /**
     * Get the [product_fk] column value.
     *
     * @return int
     */
    public function getProductFk()
    {
        return $this->product_fk;
    }

    /**
     * Get the [ocr_task_status_fk] column value.
     *
     * @return int
     */
    public function getOcrTaskStatusFk()
    {
        return $this->ocr_task_status_fk;
    }

    /**
     * Get the [task_id] column value.
     *
     * @return string
     */
    public function getTaskId()
    {
        return $this->task_id;
    }

    /**
     * Get the [optionally formatted] temporal [creation_time] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreationTime($format = NULL)
    {
        if ($format === null) {
            return $this->creation_time;
        } else {
            return $this->creation_time instanceof \DateTimeInterface ? $this->creation_time->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [start_time] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getStartTime($format = NULL)
    {
        if ($format === null) {
            return $this->start_time;
        } else {
            return $this->start_time instanceof \DateTimeInterface ? $this->start_time->format($format) : null;
        }
    }

    /**
     * Get the [start_counter] column value.
     *
     * @return int
     */
    public function getStartCounter()
    {
        return $this->start_counter;
    }

    /**
     * Get the [source_file_path] column value.
     *
     * @return string
     */
    public function getSourceFilePath()
    {
        return $this->source_file_path;
    }

    /**
     * Get the [parsed_text] column value.
     *
     * @return string
     */
    public function getParsedText()
    {
        return $this->parsed_text;
    }

    /**
     * Get the [status_message] column value.
     *
     * @return string
     */
    public function getStatusMessage()
    {
        return $this->status_message;
    }

    /**
     * Set the value of [ocr_task_pk] column.
     *
     * @param int $v new value
     * @return $this|\OcrTask The current object (for fluent API support)
     */
    public function setOcrTaskPk($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ocr_task_pk !== $v) {
            $this->ocr_task_pk = $v;
            $this->modifiedColumns[OcrTaskTableMap::COL_OCR_TASK_PK] = true;
        }

        return $this;
    } // setOcrTaskPk()

    /**
     * Set the value of [product_fk] column.
     *
     * @param int $v new value
     * @return $this|\OcrTask The current object (for fluent API support)
     */
    public function setProductFk($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->product_fk !== $v) {
            $this->product_fk = $v;
            $this->modifiedColumns[OcrTaskTableMap::COL_PRODUCT_FK] = true;
        }

        if ($this->aProduct !== null && $this->aProduct->getProductPk() !== $v) {
            $this->aProduct = null;
        }

        return $this;
    } // setProductFk()

    /**
     * Set the value of [ocr_task_status_fk] column.
     *
     * @param int $v new value
     * @return $this|\OcrTask The current object (for fluent API support)
     */
    public function setOcrTaskStatusFk($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ocr_task_status_fk !== $v) {
            $this->ocr_task_status_fk = $v;
            $this->modifiedColumns[OcrTaskTableMap::COL_OCR_TASK_STATUS_FK] = true;
        }

        if ($this->aOcrTaskStatus !== null && $this->aOcrTaskStatus->getOcrTaskStatusPk() !== $v) {
            $this->aOcrTaskStatus = null;
        }

        return $this;
    } // setOcrTaskStatusFk()

    /**
     * Set the value of [task_id] column.
     *
     * @param string $v new value
     * @return $this|\OcrTask The current object (for fluent API support)
     */
    public function setTaskId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->task_id !== $v) {
            $this->task_id = $v;
            $this->modifiedColumns[OcrTaskTableMap::COL_TASK_ID] = true;
        }

        return $this;
    } // setTaskId()

    /**
     * Sets the value of [creation_time] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\OcrTask The current object (for fluent API support)
     */
    public function setCreationTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creation_time !== null || $dt !== null) {
            if ($this->creation_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->creation_time->format("Y-m-d H:i:s.u")) {
                $this->creation_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OcrTaskTableMap::COL_CREATION_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setCreationTime()

    /**
     * Sets the value of [start_time] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\OcrTask The current object (for fluent API support)
     */
    public function setStartTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->start_time !== null || $dt !== null) {
            if ($this->start_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->start_time->format("Y-m-d H:i:s.u")) {
                $this->start_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OcrTaskTableMap::COL_START_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setStartTime()

    /**
     * Set the value of [start_counter] column.
     *
     * @param int $v new value
     * @return $this|\OcrTask The current object (for fluent API support)
     */
    public function setStartCounter($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->start_counter !== $v) {
            $this->start_counter = $v;
            $this->modifiedColumns[OcrTaskTableMap::COL_START_COUNTER] = true;
        }

        return $this;
    } // setStartCounter()

    /**
     * Set the value of [source_file_path] column.
     *
     * @param string $v new value
     * @return $this|\OcrTask The current object (for fluent API support)
     */
    public function setSourceFilePath($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->source_file_path !== $v) {
            $this->source_file_path = $v;
            $this->modifiedColumns[OcrTaskTableMap::COL_SOURCE_FILE_PATH] = true;
        }

        return $this;
    } // setSourceFilePath()

    /**
     * Set the value of [parsed_text] column.
     *
     * @param string $v new value
     * @return $this|\OcrTask The current object (for fluent API support)
     */
    public function setParsedText($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->parsed_text !== $v) {
            $this->parsed_text = $v;
            $this->modifiedColumns[OcrTaskTableMap::COL_PARSED_TEXT] = true;
        }

        return $this;
    } // setParsedText()

    /**
     * Set the value of [status_message] column.
     *
     * @param string $v new value
     * @return $this|\OcrTask The current object (for fluent API support)
     */
    public function setStatusMessage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status_message !== $v) {
            $this->status_message = $v;
            $this->modifiedColumns[OcrTaskTableMap::COL_STATUS_MESSAGE] = true;
        }

        return $this;
    } // setStatusMessage()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->ocr_task_status_fk !== 1) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OcrTaskTableMap::translateFieldName('OcrTaskPk', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ocr_task_pk = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OcrTaskTableMap::translateFieldName('ProductFk', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_fk = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OcrTaskTableMap::translateFieldName('OcrTaskStatusFk', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ocr_task_status_fk = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OcrTaskTableMap::translateFieldName('TaskId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->task_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OcrTaskTableMap::translateFieldName('CreationTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->creation_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OcrTaskTableMap::translateFieldName('StartTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OcrTaskTableMap::translateFieldName('StartCounter', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_counter = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OcrTaskTableMap::translateFieldName('SourceFilePath', TableMap::TYPE_PHPNAME, $indexType)];
            $this->source_file_path = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OcrTaskTableMap::translateFieldName('ParsedText', TableMap::TYPE_PHPNAME, $indexType)];
            $this->parsed_text = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OcrTaskTableMap::translateFieldName('StatusMessage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status_message = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = OcrTaskTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\OcrTask'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aProduct !== null && $this->product_fk !== $this->aProduct->getProductPk()) {
            $this->aProduct = null;
        }
        if ($this->aOcrTaskStatus !== null && $this->ocr_task_status_fk !== $this->aOcrTaskStatus->getOcrTaskStatusPk()) {
            $this->aOcrTaskStatus = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OcrTaskTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildOcrTaskQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aProduct = null;
            $this->aOcrTaskStatus = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see OcrTask::setDeleted()
     * @see OcrTask::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OcrTaskTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildOcrTaskQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OcrTaskTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                OcrTaskTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aProduct !== null) {
                if ($this->aProduct->isModified() || $this->aProduct->isNew()) {
                    $affectedRows += $this->aProduct->save($con);
                }
                $this->setProduct($this->aProduct);
            }

            if ($this->aOcrTaskStatus !== null) {
                if ($this->aOcrTaskStatus->isModified() || $this->aOcrTaskStatus->isNew()) {
                    $affectedRows += $this->aOcrTaskStatus->save($con);
                }
                $this->setOcrTaskStatus($this->aOcrTaskStatus);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[OcrTaskTableMap::COL_OCR_TASK_PK] = true;
        if (null !== $this->ocr_task_pk) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . OcrTaskTableMap::COL_OCR_TASK_PK . ')');
        }
        if (null === $this->ocr_task_pk) {
            try {
                $dataFetcher = $con->query("SELECT nextval('ocr_task_ocr_task_pk_seq')");
                $this->ocr_task_pk = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(OcrTaskTableMap::COL_OCR_TASK_PK)) {
            $modifiedColumns[':p' . $index++]  = 'ocr_task_pk';
        }
        if ($this->isColumnModified(OcrTaskTableMap::COL_PRODUCT_FK)) {
            $modifiedColumns[':p' . $index++]  = 'product_fk';
        }
        if ($this->isColumnModified(OcrTaskTableMap::COL_OCR_TASK_STATUS_FK)) {
            $modifiedColumns[':p' . $index++]  = 'ocr_task_status_fk';
        }
        if ($this->isColumnModified(OcrTaskTableMap::COL_TASK_ID)) {
            $modifiedColumns[':p' . $index++]  = 'task_id';
        }
        if ($this->isColumnModified(OcrTaskTableMap::COL_CREATION_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'creation_time';
        }
        if ($this->isColumnModified(OcrTaskTableMap::COL_START_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'start_time';
        }
        if ($this->isColumnModified(OcrTaskTableMap::COL_START_COUNTER)) {
            $modifiedColumns[':p' . $index++]  = 'start_counter';
        }
        if ($this->isColumnModified(OcrTaskTableMap::COL_SOURCE_FILE_PATH)) {
            $modifiedColumns[':p' . $index++]  = 'source_file_path';
        }
        if ($this->isColumnModified(OcrTaskTableMap::COL_PARSED_TEXT)) {
            $modifiedColumns[':p' . $index++]  = 'parsed_text';
        }
        if ($this->isColumnModified(OcrTaskTableMap::COL_STATUS_MESSAGE)) {
            $modifiedColumns[':p' . $index++]  = 'status_message';
        }

        $sql = sprintf(
            'INSERT INTO ocr_task (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'ocr_task_pk':
                        $stmt->bindValue($identifier, $this->ocr_task_pk, PDO::PARAM_INT);
                        break;
                    case 'product_fk':
                        $stmt->bindValue($identifier, $this->product_fk, PDO::PARAM_INT);
                        break;
                    case 'ocr_task_status_fk':
                        $stmt->bindValue($identifier, $this->ocr_task_status_fk, PDO::PARAM_INT);
                        break;
                    case 'task_id':
                        $stmt->bindValue($identifier, $this->task_id, PDO::PARAM_STR);
                        break;
                    case 'creation_time':
                        $stmt->bindValue($identifier, $this->creation_time ? $this->creation_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'start_time':
                        $stmt->bindValue($identifier, $this->start_time ? $this->start_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'start_counter':
                        $stmt->bindValue($identifier, $this->start_counter, PDO::PARAM_INT);
                        break;
                    case 'source_file_path':
                        $stmt->bindValue($identifier, $this->source_file_path, PDO::PARAM_STR);
                        break;
                    case 'parsed_text':
                        $stmt->bindValue($identifier, $this->parsed_text, PDO::PARAM_STR);
                        break;
                    case 'status_message':
                        $stmt->bindValue($identifier, $this->status_message, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = OcrTaskTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getOcrTaskPk();
                break;
            case 1:
                return $this->getProductFk();
                break;
            case 2:
                return $this->getOcrTaskStatusFk();
                break;
            case 3:
                return $this->getTaskId();
                break;
            case 4:
                return $this->getCreationTime();
                break;
            case 5:
                return $this->getStartTime();
                break;
            case 6:
                return $this->getStartCounter();
                break;
            case 7:
                return $this->getSourceFilePath();
                break;
            case 8:
                return $this->getParsedText();
                break;
            case 9:
                return $this->getStatusMessage();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['OcrTask'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['OcrTask'][$this->hashCode()] = true;
        $keys = OcrTaskTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getOcrTaskPk(),
            $keys[1] => $this->getProductFk(),
            $keys[2] => $this->getOcrTaskStatusFk(),
            $keys[3] => $this->getTaskId(),
            $keys[4] => $this->getCreationTime(),
            $keys[5] => $this->getStartTime(),
            $keys[6] => $this->getStartCounter(),
            $keys[7] => $this->getSourceFilePath(),
            $keys[8] => $this->getParsedText(),
            $keys[9] => $this->getStatusMessage(),
        );
        if ($result[$keys[4]] instanceof \DateTime) {
            $result[$keys[4]] = $result[$keys[4]]->format('c');
        }

        if ($result[$keys[5]] instanceof \DateTime) {
            $result[$keys[5]] = $result[$keys[5]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aProduct) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'product';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'product';
                        break;
                    default:
                        $key = 'Product';
                }

                $result[$key] = $this->aProduct->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aOcrTaskStatus) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ocrTaskStatus';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ocr_task_status';
                        break;
                    default:
                        $key = 'OcrTaskStatus';
                }

                $result[$key] = $this->aOcrTaskStatus->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\OcrTask
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = OcrTaskTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\OcrTask
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setOcrTaskPk($value);
                break;
            case 1:
                $this->setProductFk($value);
                break;
            case 2:
                $this->setOcrTaskStatusFk($value);
                break;
            case 3:
                $this->setTaskId($value);
                break;
            case 4:
                $this->setCreationTime($value);
                break;
            case 5:
                $this->setStartTime($value);
                break;
            case 6:
                $this->setStartCounter($value);
                break;
            case 7:
                $this->setSourceFilePath($value);
                break;
            case 8:
                $this->setParsedText($value);
                break;
            case 9:
                $this->setStatusMessage($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = OcrTaskTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOcrTaskPk($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setProductFk($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setOcrTaskStatusFk($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setTaskId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCreationTime($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setStartTime($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setStartCounter($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setSourceFilePath($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setParsedText($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setStatusMessage($arr[$keys[9]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\OcrTask The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(OcrTaskTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OcrTaskTableMap::COL_OCR_TASK_PK)) {
            $criteria->add(OcrTaskTableMap::COL_OCR_TASK_PK, $this->ocr_task_pk);
        }
        if ($this->isColumnModified(OcrTaskTableMap::COL_PRODUCT_FK)) {
            $criteria->add(OcrTaskTableMap::COL_PRODUCT_FK, $this->product_fk);
        }
        if ($this->isColumnModified(OcrTaskTableMap::COL_OCR_TASK_STATUS_FK)) {
            $criteria->add(OcrTaskTableMap::COL_OCR_TASK_STATUS_FK, $this->ocr_task_status_fk);
        }
        if ($this->isColumnModified(OcrTaskTableMap::COL_TASK_ID)) {
            $criteria->add(OcrTaskTableMap::COL_TASK_ID, $this->task_id);
        }
        if ($this->isColumnModified(OcrTaskTableMap::COL_CREATION_TIME)) {
            $criteria->add(OcrTaskTableMap::COL_CREATION_TIME, $this->creation_time);
        }
        if ($this->isColumnModified(OcrTaskTableMap::COL_START_TIME)) {
            $criteria->add(OcrTaskTableMap::COL_START_TIME, $this->start_time);
        }
        if ($this->isColumnModified(OcrTaskTableMap::COL_START_COUNTER)) {
            $criteria->add(OcrTaskTableMap::COL_START_COUNTER, $this->start_counter);
        }
        if ($this->isColumnModified(OcrTaskTableMap::COL_SOURCE_FILE_PATH)) {
            $criteria->add(OcrTaskTableMap::COL_SOURCE_FILE_PATH, $this->source_file_path);
        }
        if ($this->isColumnModified(OcrTaskTableMap::COL_PARSED_TEXT)) {
            $criteria->add(OcrTaskTableMap::COL_PARSED_TEXT, $this->parsed_text);
        }
        if ($this->isColumnModified(OcrTaskTableMap::COL_STATUS_MESSAGE)) {
            $criteria->add(OcrTaskTableMap::COL_STATUS_MESSAGE, $this->status_message);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildOcrTaskQuery::create();
        $criteria->add(OcrTaskTableMap::COL_OCR_TASK_PK, $this->ocr_task_pk);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getOcrTaskPk();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getOcrTaskPk();
    }

    /**
     * Generic method to set the primary key (ocr_task_pk column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setOcrTaskPk($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getOcrTaskPk();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \OcrTask (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setProductFk($this->getProductFk());
        $copyObj->setOcrTaskStatusFk($this->getOcrTaskStatusFk());
        $copyObj->setTaskId($this->getTaskId());
        $copyObj->setCreationTime($this->getCreationTime());
        $copyObj->setStartTime($this->getStartTime());
        $copyObj->setStartCounter($this->getStartCounter());
        $copyObj->setSourceFilePath($this->getSourceFilePath());
        $copyObj->setParsedText($this->getParsedText());
        $copyObj->setStatusMessage($this->getStatusMessage());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setOcrTaskPk(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \OcrTask Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildProduct object.
     *
     * @param  ChildProduct $v
     * @return $this|\OcrTask The current object (for fluent API support)
     * @throws PropelException
     */
    public function setProduct(ChildProduct $v = null)
    {
        if ($v === null) {
            $this->setProductFk(NULL);
        } else {
            $this->setProductFk($v->getProductPk());
        }

        $this->aProduct = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildProduct object, it will not be re-added.
        if ($v !== null) {
            $v->addOcrTask($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildProduct object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildProduct The associated ChildProduct object.
     * @throws PropelException
     */
    public function getProduct(ConnectionInterface $con = null)
    {
        if ($this->aProduct === null && ($this->product_fk !== null)) {
            $this->aProduct = ChildProductQuery::create()->findPk($this->product_fk, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProduct->addOcrTasks($this);
             */
        }

        return $this->aProduct;
    }

    /**
     * Declares an association between this object and a ChildOcrTaskStatus object.
     *
     * @param  ChildOcrTaskStatus $v
     * @return $this|\OcrTask The current object (for fluent API support)
     * @throws PropelException
     */
    public function setOcrTaskStatus(ChildOcrTaskStatus $v = null)
    {
        if ($v === null) {
            $this->setOcrTaskStatusFk(1);
        } else {
            $this->setOcrTaskStatusFk($v->getOcrTaskStatusPk());
        }

        $this->aOcrTaskStatus = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOcrTaskStatus object, it will not be re-added.
        if ($v !== null) {
            $v->addOcrTask($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOcrTaskStatus object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildOcrTaskStatus The associated ChildOcrTaskStatus object.
     * @throws PropelException
     */
    public function getOcrTaskStatus(ConnectionInterface $con = null)
    {
        if ($this->aOcrTaskStatus === null && ($this->ocr_task_status_fk !== null)) {
            $this->aOcrTaskStatus = ChildOcrTaskStatusQuery::create()->findPk($this->ocr_task_status_fk, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOcrTaskStatus->addOcrTasks($this);
             */
        }

        return $this->aOcrTaskStatus;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aProduct) {
            $this->aProduct->removeOcrTask($this);
        }
        if (null !== $this->aOcrTaskStatus) {
            $this->aOcrTaskStatus->removeOcrTask($this);
        }
        $this->ocr_task_pk = null;
        $this->product_fk = null;
        $this->ocr_task_status_fk = null;
        $this->task_id = null;
        $this->creation_time = null;
        $this->start_time = null;
        $this->start_counter = null;
        $this->source_file_path = null;
        $this->parsed_text = null;
        $this->status_message = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

        $this->aProduct = null;
        $this->aOcrTaskStatus = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OcrTaskTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
