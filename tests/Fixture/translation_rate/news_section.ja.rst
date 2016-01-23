##################
ニュースセクション
##################

前回我々はフレームワークの基本的な部分を静的ページをロードするクラスを
書きながら学んでいきました。独自のルーティング規則を追加する事により URI
を綺麗にすることもしました。
次は動的コンテンツについて学び、データベースを使ってみましょう。

モデルの準備
---------------------

データベース操作をコントローラに直接各書くより、クエリは後で再利用
しやすくなるようにモデル内に記述されるべきです。モデルとは、データベースや
他のデータ格納場所からデータを抽出したり、追加したり、更新する場所です。
モデルはデータを表現します。

*application/models/* ディレクトリを開き、新しく *News_model.php* という
ファイルを作成して、次のコードを記述してください。データベースの設定が :doc:`here <../database/configuration>` で記述されているように適切であることも
確認してください。

::

	<?php
	class News_model extends CI_Model {

		public function __construct()
		{
			$this->load->database();
		}
	}

This code looks similar to the controller code that was used earlier. It
creates a new model by extending ``CI_Model`` and loads the database
library. This will make the database class available through the
``$this->db`` object.

Before querying the database, a database schema has to be created.
Connect to your database and run the SQL command below (MySQL).
Also add some seed records.

::

	CREATE TABLE news (
		id int(11) NOT NULL AUTO_INCREMENT,
		title varchar(128) NOT NULL,
		slug varchar(128) NOT NULL,
		text text NOT NULL,
		PRIMARY KEY (id),
		KEY slug (slug)
	);

Now that the database and a model have been set up, you'll need a method
to get all of our posts from our database. To do this, the database
abstraction layer that is included with CodeIgniter — 
:doc:`Query Builder <../database/query_builder>` — is used. This makes it
possible to write your 'queries' once and make them work on :doc:`all
supported database systems <../general/requirements>`. Add the
following code to your model.

::

	public function get_news($slug = FALSE)
	{
		if ($slug === FALSE)
		{
			$query = $this->db->get('news');
			return $query->result_array();
		}

		$query = $this->db->get_where('news', array('slug' => $slug));
		return $query->row_array();
	}

With this code you can perform two different queries. You can get all
news records, or get a news item by its `slug <#>`_. You might have
noticed that the ``$slug`` variable wasn't sanitized before running the
query; :doc:`Query Builder <../database/query_builder>` does this for you.

ニュースを表示する
------------------

Now that the queries are written, the model should be tied to the views
that are going to display the news items to the user. This could be done
in our ``Pages`` controller created earlier, but for the sake of clarity,
a new ``News`` controller is defined. Create the new controller at
*application/controllers/News.php*.

::

	<?php
	class News extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('news_model');
			$this->load->helper('url_helper');
		}

		public function index()
		{
			$data['news'] = $this->news_model->get_news();
		}

		public function view($slug = NULL)
		{
			$data['news_item'] = $this->news_model->get_news($slug);
		}
	}

Looking at the code, you may see some similarity with the files we
created earlier. First, the ``__construct()`` method: it calls the
constructor of its parent class (``CI_Controller``) and loads the model,
so it can be used in all other methods in this controller.
It also loads a collection of :doc:`URL Helper <../helpers/url_helper>`
functions, because we'll use one of them in a view later.

Next, there are two methods to view all news items and one for a specific
news item. You can see that the ``$slug`` variable is passed to the model's
method in the second method. The model is using this slug to identify the
news item to be returned.

Now the data is retrieved by the controller through our model, but
nothing is displayed yet. The next thing to do is passing this data to
the views.

::

	public function index()
	{
		$data['news'] = $this->news_model->get_news();
		$data['title'] = 'News archive';

		$this->load->view('templates/header', $data);
		$this->load->view('news/index', $data);
		$this->load->view('templates/footer');
	}

The code above gets all news records from the model and assigns it to a
variable. The value for the title is also assigned to the ``$data['title']``
element and all data is passed to the views. You now need to create a
view to render the news items. Create *application/views/news/index.php*
and add the next piece of code.

::

	<h2><?php echo $title; ?></h2>
	
	<?php foreach ($news as $news_item): ?>

		<h3><?php echo $news_item['title']; ?></h3>
		<div class="main">
			<?php echo $news_item['text']; ?>
		</div>
		<p><a href="<?php echo site_url('news/'.$news_item['slug']); ?>">View article</a></p>

	<?php endforeach; ?>

Here, each news item is looped and displayed to the user. You can see we
wrote our template in PHP mixed with HTML. If you prefer to use a template
language, you can use CodeIgniter's :doc:`Template
Parser <../libraries/parser>` class or a third party parser.

The news overview page is now done, but a page to display individual
news items is still absent. The model created earlier is made in such
way that it can easily be used for this functionality. You only need to
add some code to the controller and create a new view. Go back to the
``News`` controller and update ``view()`` with the following:

::

	public function view($slug = NULL)
	{
		$data['news_item'] = $this->news_model->get_news($slug);

		if (empty($data['news_item']))
		{
			show_404();
		}

		$data['title'] = $data['news_item']['title'];

		$this->load->view('templates/header', $data);
		$this->load->view('news/view', $data);
		$this->load->view('templates/footer');
	}

Instead of calling the ``get_news()`` method without a parameter, the
``$slug`` variable is passed, so it will return the specific news item.
The only things left to do is create the corresponding view at
*application/views/news/view.php*. Put the following code in this file.

::

	<?php
	echo '<h2>'.$news_item['title'].'</h2>';
	echo $news_item['text'];

ルーティング
-------------

Because of the wildcard routing rule created earlier, you need an extra
route to view the controller that you just made. Modify your routing file
(*application/config/routes.php*) so it looks as follows.
This makes sure the requests reaches the ``News`` controller instead of
going directly to the ``Pages`` controller. The first line routes URI's
with a slug to the ``view()`` method in the ``News`` controller.

::

	$route['news/(:any)'] = 'news/view/$1';
	$route['news'] = 'news';
	$route['(:any)'] = 'pages/view/$1';
	$route['default_controller'] = 'pages/view';

ブラウザであなたのドキュメントルートに行き、
そのあとに index.php/news にアクセスしてニュースページを見てみてください。

Note: このファイルは翻訳途中のファイルです。
