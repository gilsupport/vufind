<?php
/**
 * Solr Collection aspect of the Search Multi-class (Options)
 *
 * PHP version 5
 *
 * Copyright (C) Villanova University 2010.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @category VuFind2
 * @package  Search_SolrAuthor
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     http://vufind.org   Main Site
 */
namespace VuFind\Search\SolrCollection;
use VuFind\Config\Reader as ConfigReader;

/**
 * Solr Collection Search Options
 *
 * @category VuFind2
 * @package  Search_SolrAuthor
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     http://vufind.org   Main Site
 */
class Options extends \VuFind\Search\Solr\Options
{
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        // Load sort preferences (or defaults if none in .ini file):
        $searchSettings = ConfigReader::getConfig('Collection');
        if (isset($searchSettings->Sorting)) {
            $this->sortOptions = array();
            foreach ($searchSettings->Sorting as $key => $value) {
                $this->sortOptions[$key] = $value;
            }
        } else {
            $this->sortOptions = array(
                'title' => 'sort_title',
                'year' => 'sort_year', 'year asc' => 'sort_year asc',
                'author' => 'sort_author'
            );
        }
        $this->defaultSort = key($this->sortOptions);
    }
}