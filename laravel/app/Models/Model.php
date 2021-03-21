<?php namespace App\Models;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

abstract class Model implements Arrayable {
	
	use HasAttributes;
	
	/**
	 * Query process
	 * 
	 * @var \Illuminate\Database\Query\Builder
	 */
	protected $query;
	
	/**
	 * @var string
	 */
	protected $primaryKey = 'id';
	
	/**
	 * Defining table name of the model
	 * 
	 * @var string
	 */
	protected $table;
	
	/**
	 * Event callbacks storage
	 * 
	 * @var array
	 */
	protected $events = [];
	
	/**
	 * Available columns for mass assignable
	 * 
	 * @var array
	 */
	protected $fillable = [];
	
	public function __construct(array $attributes = []) {
		$this->setAttributes($attributes);
		$this->boot();
	}
	
	/**
	 * Botting model
	 */
	protected function boot() {
		$this->initTableName();
	}
	
	/**
	 * Defines table name by the class name
	 * if not defined
	 */
	private function initTableName() {
		if($this->table) {
			return;
		}
		
		$reflection = new \ReflectionClass($this);
		$shortName = Str::plural($reflection->getShortName());		
		$this->table = Str::plural(Str::snake($shortName));
	}
	
	/**
	 * Check event
	 * 
	 * @param string $event
	 * @return bool
	 */
	private function hasEvent(string $event):bool {
		return isset($this->events[$event]);
	}
	
	/**
	 * Get event by name
	 * 
	 * @param string $event
	 * @return \Closure
	 */
	private function getEvent(string $event):\Closure {
		return $this->events[$event];
	}
	
	private function transformItemCallback():\Closure {
		return function ($item) {
			$model = new static();
			$model->pushAttributes((array) $item);
			return $model;
		};
	}
	
	/**
	 * Get table name
	 * 
	 * @return string
	 */
	public function getTable():string {
		return $this->table;
	}
	
	/**
	 * Get primary key
	 * 
	 * @return string
	 */
	public function getPrimaryKey(): string {
		return $this->primaryKey;
	}
	
	
	/**
	 * Get new model
	 * 
	 * @return \App\Models\Model
	 */
	public static function query():Model {
		$model = (new static);
		return $model->newQuery();
	}
	
	
	/**
	 * Init query builder property
	 * 
	 * @return \App\Models\Model
	 */
	public function newQuery():Model {
		$this->query = DB::table($this->getTable());
		
		return $this;
	}
	
	/**
	 * @return \Illuminate\Database\Query\Builder
	 */
	public function getQuery(): \Illuminate\Database\Query\Builder {
		if(!$this->query) $this->newQuery();
		
		return $this->query;
	}
	
	/**
	 * Add a basic where clause to the query.
	 *
	 * @param  string|array|\Closure  $column
	 * @param  mixed   $operator
	 * @param  mixed   $value
	 * @param  string  $boolean
	 * @return $this
	 */
	public function where($column, $operator = null, $value = null, $boolean = 'and') {		
		$this->query->where($column, $operator, $value, $boolean);
		
		return $this;
	}
	
	/**
	 * Add a "where in" clause to the query.
	 *
	 * @param  string  $column
	 * @param  mixed   $values
	 * @param  string  $boolean
	 * @param  bool    $not
	 * @return $this
	 */
	public function whereIn($column, $values, $boolean = 'and', $not = false) {
		$this->query->whereIn($column, $values, $boolean, $not);
		
		return $this;
	}
	
	/**
	 * Check if exist model
	 * 
	 * @return bool
	 */
	public function exist():bool {
		return $this->query->exists();
	}
	
	/**
	 * Set the columns to be selected.
	 *
	 * @param  array|mixed  $columns
	 * @return $this
	 */
	public function select($columns = ['*']) {
		$this->query->select($columns);
	}
	
	/**
	 * Execute the query as a "select" statement.
	 *
	 * @param  array|string  $columns
	 * @return \Illuminate\Support\Collection
	 */
	public function get($columns = ['*']) {
		$collection = $this->query->get($columns);
		
		return $collection->transform($this->transformItemCallback());
	}
	
	/**
	 * Find model by defined primary key
	 * 
	 * @param       $id
	 * @param array $columns
	 * @return $this|null
	 */
	public static function find($id, array $columns = ['*']) {
		return static::query()
			->where((new static)->getPrimaryKey(), $id)
			->get($columns)
			->first();
	}
	
	/**
	 * Get first created model
	 *
	 * @param array $columns
	 * @return $this|null
	 */
	public static function first(array $columns = ['*']) {
		$item = (new static)->getQuery()
			->first($columns);
		
		if(!$item) {
			return null;
		}
		
		$transormCallback = (new static)->transformItemCallback();		
		return $transormCallback($item);
	}
	
	/**
	 * Put the query's results in random order.
	 *
	 * @param  string  $seed
	 * @return $this
	 */
	public function inRandomOrder($seed = '') {
		$this->query->inRandomOrder($seed);
		
		return $this;
	}
	
	/**
	 * Set the "limit" value of the query.
	 *
	 * @param  int  $value
	 * @return $this
	 */
	public function limit(int $value) {
		$this->query->limit($value);
		
		return $this;
	}
	
	/**
	 * Add an "order by" clause to the query.
	 *
	 * @param  string  $column
	 * @param  string  $direction
	 * @return $this
	 *
	 * @throws \InvalidArgumentException
	 */
	public function orderBy($column, $direction = 'asc') {
		$this->query->orderBy($column, $direction);
		
		return $this;
	}
	
	/**
	 * Add a descending "order by" clause to the query.
	 *
	 * @param  string  $column
	 * @return $this
	 */
	public function orderByDesc($column) {
		$this->query->orderByDesc($column, 'desc');
		
		return $this;
	}
	
	/**
	 * @param array $columns
	 * @return \Illuminate\Support\Collection
	 */
	public static function all($columns = ['*']) {
		return static::query()
			->get($columns);
	}
	
	/**
	 * Defines callback before create the model
	 * 
	 * @param \Closure $callback
	 */
	final public function creating(\Closure $callback) {
		$this->events['creating'] = $callback;
	}
	
	/**
	 * Create model
	 * 
	 * @param array $attributes
	 * @return $this
	 */
	final public static function create(array $attributes) {
		$model = new static($attributes);
		$id = null;
		
		DB::transaction(function () use ($model, &$id) {
			if($model->hasEvent('creating')) {
				call_user_func($model->getEvent('creating'), ...[&$model]);
			}
			
			$id = $model->getQuery()
				->insertGetId($model->getAttributes());
		});
		
		return static::query()
			->where('id', $id)
			->get()
			->first();
	}
	
	/**
	 * Defines callback before update the model
	 *
	 * @param \Closure $callback
	 */
	final public function updating(\Closure $callback) {
		$this->events['updating'] = $callback;
	}
	
	/**
	 * Update model
	 * 
	 * @param array $attributes
	 * @return $this
	 * @throws \App\Models\ModelException
	 */
	public function update(array $attributes = []) {
		$keys = array_keys($attributes);
		
		foreach ($keys as $key) {
			if(!in_array($key, $this->fillable)) {
				throw new ModelException("[{$key}] must be added in fillable property for mass assignable");
			}
		}
		
		$this->setAttributes($attributes);
		
		DB::transaction(function () {
			if($this->hasEvent('updating')) {
				call_user_func($this->getEvent('updating'), ...[&$this]);
			}
			
			$this->getQuery()
				->where($this->primaryKey, $this->getAttribute($this->primaryKey))
				->update($this->getAttributes());
		});
		
		
		
		return $this;
	}
	
	/**
	 * Defines callback before delete the model
	 *
	 * @param \Closure $callback
	 */
	final public function deleting(\Closure $callback) {
		$this->events['deleting'] = $callback;
	}
	
	/**
	 * Delete model
	 * 
	 * @return int
	 */
	public function delete() {
		
		DB::transaction(function () {
			if($this->hasEvent('deleting')) {
				call_user_func($this->getEvent('deleting'), ...[&$this]);
			}
			
			$result = $this->getQuery()
				->where('id', $this->id)
				->delete();
		});
	}
	
	
	public function toArray():array {
		return $this->attributes;
	}
	
	public function __set($name, $value) {
		$this->setAttribute($name, $value);
	}
	
	public function __get($name) {
		return $this->getAttribute($name);
	}
	
	
}