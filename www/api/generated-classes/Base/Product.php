<?php

namespace Base;

use \Dossier as ChildDossier;
use \DossierQuery as ChildDossierQuery;
use \OcrTask as ChildOcrTask;
use \OcrTaskQuery as ChildOcrTaskQuery;
use \Product as ChildProduct;
use \ProductComment as ChildProductComment;
use \ProductCommentQuery as ChildProductCommentQuery;
use \ProductQuery as ChildProductQuery;
use \Store as ChildStore;
use \StoreChain as ChildStoreChain;
use \StoreChainQuery as ChildStoreChainQuery;
use \StoreQuery as ChildStoreQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\OcrTaskTableMap;
use Map\ProductCommentTableMap;
use Map\ProductTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'product' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Product implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ProductTableMap';


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
     * The value for the product_pk field.
     *
     * @var        int
     */
    protected $product_pk;

    /**
     * The value for the dossier_fk field.
     *
     * @var        int
     */
    protected $dossier_fk;

    /**
     * The value for the store_fk field.
     *
     * @var        int
     */
    protected $store_fk;

    /**
     * The value for the store_chain_fk field.
     *
     * @var        int
     */
    protected $store_chain_fk;

    /**
     * The value for the creation_date field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_DATE
     * @var        DateTime
     */
    protected $creation_date;

    /**
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the description field.
     *
     * @var        string
     */
    protected $description;

    /**
     * The value for the price field.
     *
     * @var        string
     */
    protected $price;

    /**
     * The value for the purchase_date field.
     *
     * @var        DateTime
     */
    protected $purchase_date;

    /**
     * The value for the due_date field.
     *
     * @var        DateTime
     */
    protected $due_date;

    /**
     * @var        ChildDossier
     */
    protected $aDossier;

    /**
     * @var        ChildStore
     */
    protected $aStore;

    /**
     * @var        ChildStoreChain
     */
    protected $aStoreChain;

    /**
     * @var        ObjectCollection|ChildProductComment[] Collection to store aggregation of ChildProductComment objects.
     */
    protected $collProductComments;
    protected $collProductCommentsPartial;

    /**
     * @var        ObjectCollection|ChildOcrTask[] Collection to store aggregation of ChildOcrTask objects.
     */
    protected $collOcrTasks;
    protected $collOcrTasksPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductComment[]
     */
    protected $productCommentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOcrTask[]
     */
    protected $ocrTasksScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
    }

    /**
     * Initializes internal state of Base\Product object.
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
     * Compares this with another <code>Product</code> instance.  If
     * <code>obj</code> is an instance of <code>Product</code>, delegates to
     * <code>equals(Product)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Product The current object, for fluid interface
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
     * Get the [product_pk] column value.
     *
     * @return int
     */
    public function getProductPk()
    {
        return $this->product_pk;
    }

    /**
     * Get the [dossier_fk] column value.
     *
     * @return int
     */
    public function getDossierFk()
    {
        return $this->dossier_fk;
    }

    /**
     * Get the [store_fk] column value.
     *
     * @return int
     */
    public function getStoreFk()
    {
        return $this->store_fk;
    }

    /**
     * Get the [store_chain_fk] column value.
     *
     * @return int
     */
    public function getStoreChainFk()
    {
        return $this->store_chain_fk;
    }

    /**
     * Get the [optionally formatted] temporal [creation_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreationDate($format = NULL)
    {
        if ($format === null) {
            return $this->creation_date;
        } else {
            return $this->creation_date instanceof \DateTimeInterface ? $this->creation_date->format($format) : null;
        }
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [price] column value.
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get the [optionally formatted] temporal [purchase_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getPurchaseDate($format = NULL)
    {
        if ($format === null) {
            return $this->purchase_date;
        } else {
            return $this->purchase_date instanceof \DateTimeInterface ? $this->purchase_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [due_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDueDate($format = NULL)
    {
        if ($format === null) {
            return $this->due_date;
        } else {
            return $this->due_date instanceof \DateTimeInterface ? $this->due_date->format($format) : null;
        }
    }

    /**
     * Set the value of [product_pk] column.
     *
     * @param int $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setProductPk($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->product_pk !== $v) {
            $this->product_pk = $v;
            $this->modifiedColumns[ProductTableMap::COL_PRODUCT_PK] = true;
        }

        return $this;
    } // setProductPk()

    /**
     * Set the value of [dossier_fk] column.
     *
     * @param int $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setDossierFk($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->dossier_fk !== $v) {
            $this->dossier_fk = $v;
            $this->modifiedColumns[ProductTableMap::COL_DOSSIER_FK] = true;
        }

        if ($this->aDossier !== null && $this->aDossier->getDossierPk() !== $v) {
            $this->aDossier = null;
        }

        return $this;
    } // setDossierFk()

    /**
     * Set the value of [store_fk] column.
     *
     * @param int $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setStoreFk($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->store_fk !== $v) {
            $this->store_fk = $v;
            $this->modifiedColumns[ProductTableMap::COL_STORE_FK] = true;
        }

        if ($this->aStore !== null && $this->aStore->getStorePk() !== $v) {
            $this->aStore = null;
        }

        return $this;
    } // setStoreFk()

    /**
     * Set the value of [store_chain_fk] column.
     *
     * @param int $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setStoreChainFk($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->store_chain_fk !== $v) {
            $this->store_chain_fk = $v;
            $this->modifiedColumns[ProductTableMap::COL_STORE_CHAIN_FK] = true;
        }

        if ($this->aStoreChain !== null && $this->aStoreChain->getStoreChainPk() !== $v) {
            $this->aStoreChain = null;
        }

        return $this;
    } // setStoreChainFk()

    /**
     * Sets the value of [creation_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setCreationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creation_date !== null || $dt !== null) {
            if ($this->creation_date === null || $dt === null || $dt->format("Y-m-d") !== $this->creation_date->format("Y-m-d")) {
                $this->creation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProductTableMap::COL_CREATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setCreationDate()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[ProductTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[ProductTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [price] column.
     *
     * @param string $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setPrice($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->price !== $v) {
            $this->price = $v;
            $this->modifiedColumns[ProductTableMap::COL_PRICE] = true;
        }

        return $this;
    } // setPrice()

    /**
     * Sets the value of [purchase_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setPurchaseDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->purchase_date !== null || $dt !== null) {
            if ($this->purchase_date === null || $dt === null || $dt->format("Y-m-d") !== $this->purchase_date->format("Y-m-d")) {
                $this->purchase_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProductTableMap::COL_PURCHASE_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setPurchaseDate()

    /**
     * Sets the value of [due_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setDueDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->due_date !== null || $dt !== null) {
            if ($this->due_date === null || $dt === null || $dt->format("Y-m-d") !== $this->due_date->format("Y-m-d")) {
                $this->due_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProductTableMap::COL_DUE_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setDueDate()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ProductTableMap::translateFieldName('ProductPk', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_pk = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ProductTableMap::translateFieldName('DossierFk', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dossier_fk = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ProductTableMap::translateFieldName('StoreFk', TableMap::TYPE_PHPNAME, $indexType)];
            $this->store_fk = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ProductTableMap::translateFieldName('StoreChainFk', TableMap::TYPE_PHPNAME, $indexType)];
            $this->store_chain_fk = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ProductTableMap::translateFieldName('CreationDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->creation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ProductTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ProductTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ProductTableMap::translateFieldName('Price', TableMap::TYPE_PHPNAME, $indexType)];
            $this->price = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ProductTableMap::translateFieldName('PurchaseDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->purchase_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ProductTableMap::translateFieldName('DueDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->due_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = ProductTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Product'), 0, $e);
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
        if ($this->aDossier !== null && $this->dossier_fk !== $this->aDossier->getDossierPk()) {
            $this->aDossier = null;
        }
        if ($this->aStore !== null && $this->store_fk !== $this->aStore->getStorePk()) {
            $this->aStore = null;
        }
        if ($this->aStoreChain !== null && $this->store_chain_fk !== $this->aStoreChain->getStoreChainPk()) {
            $this->aStoreChain = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ProductTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildProductQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aDossier = null;
            $this->aStore = null;
            $this->aStoreChain = null;
            $this->collProductComments = null;

            $this->collOcrTasks = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Product::setDeleted()
     * @see Product::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildProductQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
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
                ProductTableMap::addInstanceToPool($this);
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

            if ($this->aDossier !== null) {
                if ($this->aDossier->isModified() || $this->aDossier->isNew()) {
                    $affectedRows += $this->aDossier->save($con);
                }
                $this->setDossier($this->aDossier);
            }

            if ($this->aStore !== null) {
                if ($this->aStore->isModified() || $this->aStore->isNew()) {
                    $affectedRows += $this->aStore->save($con);
                }
                $this->setStore($this->aStore);
            }

            if ($this->aStoreChain !== null) {
                if ($this->aStoreChain->isModified() || $this->aStoreChain->isNew()) {
                    $affectedRows += $this->aStoreChain->save($con);
                }
                $this->setStoreChain($this->aStoreChain);
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

            if ($this->productCommentsScheduledForDeletion !== null) {
                if (!$this->productCommentsScheduledForDeletion->isEmpty()) {
                    \ProductCommentQuery::create()
                        ->filterByPrimaryKeys($this->productCommentsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productCommentsScheduledForDeletion = null;
                }
            }

            if ($this->collProductComments !== null) {
                foreach ($this->collProductComments as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->ocrTasksScheduledForDeletion !== null) {
                if (!$this->ocrTasksScheduledForDeletion->isEmpty()) {
                    \OcrTaskQuery::create()
                        ->filterByPrimaryKeys($this->ocrTasksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ocrTasksScheduledForDeletion = null;
                }
            }

            if ($this->collOcrTasks !== null) {
                foreach ($this->collOcrTasks as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[ProductTableMap::COL_PRODUCT_PK] = true;
        if (null !== $this->product_pk) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ProductTableMap::COL_PRODUCT_PK . ')');
        }
        if (null === $this->product_pk) {
            try {
                $dataFetcher = $con->query("SELECT nextval('product_product_pk_seq')");
                $this->product_pk = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_PK)) {
            $modifiedColumns[':p' . $index++]  = 'product_pk';
        }
        if ($this->isColumnModified(ProductTableMap::COL_DOSSIER_FK)) {
            $modifiedColumns[':p' . $index++]  = 'dossier_fk';
        }
        if ($this->isColumnModified(ProductTableMap::COL_STORE_FK)) {
            $modifiedColumns[':p' . $index++]  = 'store_fk';
        }
        if ($this->isColumnModified(ProductTableMap::COL_STORE_CHAIN_FK)) {
            $modifiedColumns[':p' . $index++]  = 'store_chain_fk';
        }
        if ($this->isColumnModified(ProductTableMap::COL_CREATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'creation_date';
        }
        if ($this->isColumnModified(ProductTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(ProductTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'price';
        }
        if ($this->isColumnModified(ProductTableMap::COL_PURCHASE_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'purchase_date';
        }
        if ($this->isColumnModified(ProductTableMap::COL_DUE_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'due_date';
        }

        $sql = sprintf(
            'INSERT INTO product (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'product_pk':
                        $stmt->bindValue($identifier, $this->product_pk, PDO::PARAM_INT);
                        break;
                    case 'dossier_fk':
                        $stmt->bindValue($identifier, $this->dossier_fk, PDO::PARAM_INT);
                        break;
                    case 'store_fk':
                        $stmt->bindValue($identifier, $this->store_fk, PDO::PARAM_INT);
                        break;
                    case 'store_chain_fk':
                        $stmt->bindValue($identifier, $this->store_chain_fk, PDO::PARAM_INT);
                        break;
                    case 'creation_date':
                        $stmt->bindValue($identifier, $this->creation_date ? $this->creation_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case 'price':
                        $stmt->bindValue($identifier, $this->price, PDO::PARAM_INT);
                        break;
                    case 'purchase_date':
                        $stmt->bindValue($identifier, $this->purchase_date ? $this->purchase_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'due_date':
                        $stmt->bindValue($identifier, $this->due_date ? $this->due_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
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
        $pos = ProductTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getProductPk();
                break;
            case 1:
                return $this->getDossierFk();
                break;
            case 2:
                return $this->getStoreFk();
                break;
            case 3:
                return $this->getStoreChainFk();
                break;
            case 4:
                return $this->getCreationDate();
                break;
            case 5:
                return $this->getName();
                break;
            case 6:
                return $this->getDescription();
                break;
            case 7:
                return $this->getPrice();
                break;
            case 8:
                return $this->getPurchaseDate();
                break;
            case 9:
                return $this->getDueDate();
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

        if (isset($alreadyDumpedObjects['Product'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Product'][$this->hashCode()] = true;
        $keys = ProductTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getProductPk(),
            $keys[1] => $this->getDossierFk(),
            $keys[2] => $this->getStoreFk(),
            $keys[3] => $this->getStoreChainFk(),
            $keys[4] => $this->getCreationDate(),
            $keys[5] => $this->getName(),
            $keys[6] => $this->getDescription(),
            $keys[7] => $this->getPrice(),
            $keys[8] => $this->getPurchaseDate(),
            $keys[9] => $this->getDueDate(),
        );
        if ($result[$keys[4]] instanceof \DateTime) {
            $result[$keys[4]] = $result[$keys[4]]->format('c');
        }

        if ($result[$keys[8]] instanceof \DateTime) {
            $result[$keys[8]] = $result[$keys[8]]->format('c');
        }

        if ($result[$keys[9]] instanceof \DateTime) {
            $result[$keys[9]] = $result[$keys[9]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aDossier) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'dossier';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'dossier';
                        break;
                    default:
                        $key = 'Dossier';
                }

                $result[$key] = $this->aDossier->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aStore) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'store';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'store';
                        break;
                    default:
                        $key = 'Store';
                }

                $result[$key] = $this->aStore->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aStoreChain) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'storeChain';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'store_chain';
                        break;
                    default:
                        $key = 'StoreChain';
                }

                $result[$key] = $this->aStoreChain->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collProductComments) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productComments';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'product_comments';
                        break;
                    default:
                        $key = 'ProductComments';
                }

                $result[$key] = $this->collProductComments->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOcrTasks) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ocrTasks';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ocr_tasks';
                        break;
                    default:
                        $key = 'OcrTasks';
                }

                $result[$key] = $this->collOcrTasks->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Product
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProductTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Product
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setProductPk($value);
                break;
            case 1:
                $this->setDossierFk($value);
                break;
            case 2:
                $this->setStoreFk($value);
                break;
            case 3:
                $this->setStoreChainFk($value);
                break;
            case 4:
                $this->setCreationDate($value);
                break;
            case 5:
                $this->setName($value);
                break;
            case 6:
                $this->setDescription($value);
                break;
            case 7:
                $this->setPrice($value);
                break;
            case 8:
                $this->setPurchaseDate($value);
                break;
            case 9:
                $this->setDueDate($value);
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
        $keys = ProductTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setProductPk($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setDossierFk($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setStoreFk($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setStoreChainFk($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCreationDate($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setName($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDescription($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPrice($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setPurchaseDate($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setDueDate($arr[$keys[9]]);
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
     * @return $this|\Product The current object, for fluid interface
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
        $criteria = new Criteria(ProductTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_PK)) {
            $criteria->add(ProductTableMap::COL_PRODUCT_PK, $this->product_pk);
        }
        if ($this->isColumnModified(ProductTableMap::COL_DOSSIER_FK)) {
            $criteria->add(ProductTableMap::COL_DOSSIER_FK, $this->dossier_fk);
        }
        if ($this->isColumnModified(ProductTableMap::COL_STORE_FK)) {
            $criteria->add(ProductTableMap::COL_STORE_FK, $this->store_fk);
        }
        if ($this->isColumnModified(ProductTableMap::COL_STORE_CHAIN_FK)) {
            $criteria->add(ProductTableMap::COL_STORE_CHAIN_FK, $this->store_chain_fk);
        }
        if ($this->isColumnModified(ProductTableMap::COL_CREATION_DATE)) {
            $criteria->add(ProductTableMap::COL_CREATION_DATE, $this->creation_date);
        }
        if ($this->isColumnModified(ProductTableMap::COL_NAME)) {
            $criteria->add(ProductTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(ProductTableMap::COL_DESCRIPTION)) {
            $criteria->add(ProductTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRICE)) {
            $criteria->add(ProductTableMap::COL_PRICE, $this->price);
        }
        if ($this->isColumnModified(ProductTableMap::COL_PURCHASE_DATE)) {
            $criteria->add(ProductTableMap::COL_PURCHASE_DATE, $this->purchase_date);
        }
        if ($this->isColumnModified(ProductTableMap::COL_DUE_DATE)) {
            $criteria->add(ProductTableMap::COL_DUE_DATE, $this->due_date);
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
        $criteria = ChildProductQuery::create();
        $criteria->add(ProductTableMap::COL_PRODUCT_PK, $this->product_pk);

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
        $validPk = null !== $this->getProductPk();

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
        return $this->getProductPk();
    }

    /**
     * Generic method to set the primary key (product_pk column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setProductPk($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getProductPk();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Product (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDossierFk($this->getDossierFk());
        $copyObj->setStoreFk($this->getStoreFk());
        $copyObj->setStoreChainFk($this->getStoreChainFk());
        $copyObj->setCreationDate($this->getCreationDate());
        $copyObj->setName($this->getName());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setPrice($this->getPrice());
        $copyObj->setPurchaseDate($this->getPurchaseDate());
        $copyObj->setDueDate($this->getDueDate());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getProductComments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductComment($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOcrTasks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOcrTask($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setProductPk(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Product Clone of current object.
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
     * Declares an association between this object and a ChildDossier object.
     *
     * @param  ChildDossier $v
     * @return $this|\Product The current object (for fluent API support)
     * @throws PropelException
     */
    public function setDossier(ChildDossier $v = null)
    {
        if ($v === null) {
            $this->setDossierFk(NULL);
        } else {
            $this->setDossierFk($v->getDossierPk());
        }

        $this->aDossier = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildDossier object, it will not be re-added.
        if ($v !== null) {
            $v->addProduct($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildDossier object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildDossier The associated ChildDossier object.
     * @throws PropelException
     */
    public function getDossier(ConnectionInterface $con = null)
    {
        if ($this->aDossier === null && ($this->dossier_fk !== null)) {
            $this->aDossier = ChildDossierQuery::create()->findPk($this->dossier_fk, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aDossier->addProducts($this);
             */
        }

        return $this->aDossier;
    }

    /**
     * Declares an association between this object and a ChildStore object.
     *
     * @param  ChildStore $v
     * @return $this|\Product The current object (for fluent API support)
     * @throws PropelException
     */
    public function setStore(ChildStore $v = null)
    {
        if ($v === null) {
            $this->setStoreFk(NULL);
        } else {
            $this->setStoreFk($v->getStorePk());
        }

        $this->aStore = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildStore object, it will not be re-added.
        if ($v !== null) {
            $v->addProduct($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildStore object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildStore The associated ChildStore object.
     * @throws PropelException
     */
    public function getStore(ConnectionInterface $con = null)
    {
        if ($this->aStore === null && ($this->store_fk !== null)) {
            $this->aStore = ChildStoreQuery::create()->findPk($this->store_fk, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aStore->addProducts($this);
             */
        }

        return $this->aStore;
    }

    /**
     * Declares an association between this object and a ChildStoreChain object.
     *
     * @param  ChildStoreChain $v
     * @return $this|\Product The current object (for fluent API support)
     * @throws PropelException
     */
    public function setStoreChain(ChildStoreChain $v = null)
    {
        if ($v === null) {
            $this->setStoreChainFk(NULL);
        } else {
            $this->setStoreChainFk($v->getStoreChainPk());
        }

        $this->aStoreChain = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildStoreChain object, it will not be re-added.
        if ($v !== null) {
            $v->addProduct($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildStoreChain object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildStoreChain The associated ChildStoreChain object.
     * @throws PropelException
     */
    public function getStoreChain(ConnectionInterface $con = null)
    {
        if ($this->aStoreChain === null && ($this->store_chain_fk !== null)) {
            $this->aStoreChain = ChildStoreChainQuery::create()->findPk($this->store_chain_fk, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aStoreChain->addProducts($this);
             */
        }

        return $this->aStoreChain;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('ProductComment' == $relationName) {
            return $this->initProductComments();
        }
        if ('OcrTask' == $relationName) {
            return $this->initOcrTasks();
        }
    }

    /**
     * Clears out the collProductComments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProductComments()
     */
    public function clearProductComments()
    {
        $this->collProductComments = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProductComments collection loaded partially.
     */
    public function resetPartialProductComments($v = true)
    {
        $this->collProductCommentsPartial = $v;
    }

    /**
     * Initializes the collProductComments collection.
     *
     * By default this just sets the collProductComments collection to an empty array (like clearcollProductComments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductComments($overrideExisting = true)
    {
        if (null !== $this->collProductComments && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductCommentTableMap::getTableMap()->getCollectionClassName();

        $this->collProductComments = new $collectionClassName;
        $this->collProductComments->setModel('\ProductComment');
    }

    /**
     * Gets an array of ChildProductComment objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProduct is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductComment[] List of ChildProductComment objects
     * @throws PropelException
     */
    public function getProductComments(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProductCommentsPartial && !$this->isNew();
        if (null === $this->collProductComments || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProductComments) {
                // return empty collection
                $this->initProductComments();
            } else {
                $collProductComments = ChildProductCommentQuery::create(null, $criteria)
                    ->filterByProduct($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductCommentsPartial && count($collProductComments)) {
                        $this->initProductComments(false);

                        foreach ($collProductComments as $obj) {
                            if (false == $this->collProductComments->contains($obj)) {
                                $this->collProductComments->append($obj);
                            }
                        }

                        $this->collProductCommentsPartial = true;
                    }

                    return $collProductComments;
                }

                if ($partial && $this->collProductComments) {
                    foreach ($this->collProductComments as $obj) {
                        if ($obj->isNew()) {
                            $collProductComments[] = $obj;
                        }
                    }
                }

                $this->collProductComments = $collProductComments;
                $this->collProductCommentsPartial = false;
            }
        }

        return $this->collProductComments;
    }

    /**
     * Sets a collection of ChildProductComment objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $productComments A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function setProductComments(Collection $productComments, ConnectionInterface $con = null)
    {
        /** @var ChildProductComment[] $productCommentsToDelete */
        $productCommentsToDelete = $this->getProductComments(new Criteria(), $con)->diff($productComments);


        $this->productCommentsScheduledForDeletion = $productCommentsToDelete;

        foreach ($productCommentsToDelete as $productCommentRemoved) {
            $productCommentRemoved->setProduct(null);
        }

        $this->collProductComments = null;
        foreach ($productComments as $productComment) {
            $this->addProductComment($productComment);
        }

        $this->collProductComments = $productComments;
        $this->collProductCommentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductComment objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProductComment objects.
     * @throws PropelException
     */
    public function countProductComments(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProductCommentsPartial && !$this->isNew();
        if (null === $this->collProductComments || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductComments) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductComments());
            }

            $query = ChildProductCommentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collProductComments);
    }

    /**
     * Method called to associate a ChildProductComment object to this object
     * through the ChildProductComment foreign key attribute.
     *
     * @param  ChildProductComment $l ChildProductComment
     * @return $this|\Product The current object (for fluent API support)
     */
    public function addProductComment(ChildProductComment $l)
    {
        if ($this->collProductComments === null) {
            $this->initProductComments();
            $this->collProductCommentsPartial = true;
        }

        if (!$this->collProductComments->contains($l)) {
            $this->doAddProductComment($l);

            if ($this->productCommentsScheduledForDeletion and $this->productCommentsScheduledForDeletion->contains($l)) {
                $this->productCommentsScheduledForDeletion->remove($this->productCommentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductComment $productComment The ChildProductComment object to add.
     */
    protected function doAddProductComment(ChildProductComment $productComment)
    {
        $this->collProductComments[]= $productComment;
        $productComment->setProduct($this);
    }

    /**
     * @param  ChildProductComment $productComment The ChildProductComment object to remove.
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function removeProductComment(ChildProductComment $productComment)
    {
        if ($this->getProductComments()->contains($productComment)) {
            $pos = $this->collProductComments->search($productComment);
            $this->collProductComments->remove($pos);
            if (null === $this->productCommentsScheduledForDeletion) {
                $this->productCommentsScheduledForDeletion = clone $this->collProductComments;
                $this->productCommentsScheduledForDeletion->clear();
            }
            $this->productCommentsScheduledForDeletion[]= clone $productComment;
            $productComment->setProduct(null);
        }

        return $this;
    }

    /**
     * Clears out the collOcrTasks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addOcrTasks()
     */
    public function clearOcrTasks()
    {
        $this->collOcrTasks = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collOcrTasks collection loaded partially.
     */
    public function resetPartialOcrTasks($v = true)
    {
        $this->collOcrTasksPartial = $v;
    }

    /**
     * Initializes the collOcrTasks collection.
     *
     * By default this just sets the collOcrTasks collection to an empty array (like clearcollOcrTasks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOcrTasks($overrideExisting = true)
    {
        if (null !== $this->collOcrTasks && !$overrideExisting) {
            return;
        }

        $collectionClassName = OcrTaskTableMap::getTableMap()->getCollectionClassName();

        $this->collOcrTasks = new $collectionClassName;
        $this->collOcrTasks->setModel('\OcrTask');
    }

    /**
     * Gets an array of ChildOcrTask objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProduct is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOcrTask[] List of ChildOcrTask objects
     * @throws PropelException
     */
    public function getOcrTasks(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collOcrTasksPartial && !$this->isNew();
        if (null === $this->collOcrTasks || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collOcrTasks) {
                // return empty collection
                $this->initOcrTasks();
            } else {
                $collOcrTasks = ChildOcrTaskQuery::create(null, $criteria)
                    ->filterByProduct($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOcrTasksPartial && count($collOcrTasks)) {
                        $this->initOcrTasks(false);

                        foreach ($collOcrTasks as $obj) {
                            if (false == $this->collOcrTasks->contains($obj)) {
                                $this->collOcrTasks->append($obj);
                            }
                        }

                        $this->collOcrTasksPartial = true;
                    }

                    return $collOcrTasks;
                }

                if ($partial && $this->collOcrTasks) {
                    foreach ($this->collOcrTasks as $obj) {
                        if ($obj->isNew()) {
                            $collOcrTasks[] = $obj;
                        }
                    }
                }

                $this->collOcrTasks = $collOcrTasks;
                $this->collOcrTasksPartial = false;
            }
        }

        return $this->collOcrTasks;
    }

    /**
     * Sets a collection of ChildOcrTask objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $ocrTasks A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function setOcrTasks(Collection $ocrTasks, ConnectionInterface $con = null)
    {
        /** @var ChildOcrTask[] $ocrTasksToDelete */
        $ocrTasksToDelete = $this->getOcrTasks(new Criteria(), $con)->diff($ocrTasks);


        $this->ocrTasksScheduledForDeletion = $ocrTasksToDelete;

        foreach ($ocrTasksToDelete as $ocrTaskRemoved) {
            $ocrTaskRemoved->setProduct(null);
        }

        $this->collOcrTasks = null;
        foreach ($ocrTasks as $ocrTask) {
            $this->addOcrTask($ocrTask);
        }

        $this->collOcrTasks = $ocrTasks;
        $this->collOcrTasksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OcrTask objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related OcrTask objects.
     * @throws PropelException
     */
    public function countOcrTasks(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collOcrTasksPartial && !$this->isNew();
        if (null === $this->collOcrTasks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOcrTasks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOcrTasks());
            }

            $query = ChildOcrTaskQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collOcrTasks);
    }

    /**
     * Method called to associate a ChildOcrTask object to this object
     * through the ChildOcrTask foreign key attribute.
     *
     * @param  ChildOcrTask $l ChildOcrTask
     * @return $this|\Product The current object (for fluent API support)
     */
    public function addOcrTask(ChildOcrTask $l)
    {
        if ($this->collOcrTasks === null) {
            $this->initOcrTasks();
            $this->collOcrTasksPartial = true;
        }

        if (!$this->collOcrTasks->contains($l)) {
            $this->doAddOcrTask($l);

            if ($this->ocrTasksScheduledForDeletion and $this->ocrTasksScheduledForDeletion->contains($l)) {
                $this->ocrTasksScheduledForDeletion->remove($this->ocrTasksScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOcrTask $ocrTask The ChildOcrTask object to add.
     */
    protected function doAddOcrTask(ChildOcrTask $ocrTask)
    {
        $this->collOcrTasks[]= $ocrTask;
        $ocrTask->setProduct($this);
    }

    /**
     * @param  ChildOcrTask $ocrTask The ChildOcrTask object to remove.
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function removeOcrTask(ChildOcrTask $ocrTask)
    {
        if ($this->getOcrTasks()->contains($ocrTask)) {
            $pos = $this->collOcrTasks->search($ocrTask);
            $this->collOcrTasks->remove($pos);
            if (null === $this->ocrTasksScheduledForDeletion) {
                $this->ocrTasksScheduledForDeletion = clone $this->collOcrTasks;
                $this->ocrTasksScheduledForDeletion->clear();
            }
            $this->ocrTasksScheduledForDeletion[]= clone $ocrTask;
            $ocrTask->setProduct(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Product is new, it will return
     * an empty collection; or if this Product has previously
     * been saved, it will retrieve related OcrTasks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Product.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOcrTask[] List of ChildOcrTask objects
     */
    public function getOcrTasksJoinOcrTaskStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOcrTaskQuery::create(null, $criteria);
        $query->joinWith('OcrTaskStatus', $joinBehavior);

        return $this->getOcrTasks($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aDossier) {
            $this->aDossier->removeProduct($this);
        }
        if (null !== $this->aStore) {
            $this->aStore->removeProduct($this);
        }
        if (null !== $this->aStoreChain) {
            $this->aStoreChain->removeProduct($this);
        }
        $this->product_pk = null;
        $this->dossier_fk = null;
        $this->store_fk = null;
        $this->store_chain_fk = null;
        $this->creation_date = null;
        $this->name = null;
        $this->description = null;
        $this->price = null;
        $this->purchase_date = null;
        $this->due_date = null;
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
            if ($this->collProductComments) {
                foreach ($this->collProductComments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOcrTasks) {
                foreach ($this->collOcrTasks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collProductComments = null;
        $this->collOcrTasks = null;
        $this->aDossier = null;
        $this->aStore = null;
        $this->aStoreChain = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProductTableMap::DEFAULT_STRING_FORMAT);
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
