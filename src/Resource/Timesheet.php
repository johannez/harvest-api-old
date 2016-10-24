<?php

namespace Johannez\Harvest\Resource;


class Timesheet extends BaseResource
{
    /**
     * Get daily entries.
     *
     * @param bool $slim Return only tracked time, and no assignments.
     * @return mixed
     *
     * @see http://help.getharvest.com/api/timesheets-api/timesheets/retrieving-time-entries/#retrieve-entries-for-the-current-day
     */
    public function getDaily($slim = true)
    {
        $uri = $slim ? 'daily?slim=1' : 'daily';

        return $this->connection->makeRequest('get', $uri);
    }

    /**
     * Get entries for a specific day.
     *
     * @param bool $slim Return only tracked time, and no assignments.
     * @param int $user_id For a user other than the current.
     * @return mixed
     *
     * @see http://help.getharvest.com/api/timesheets-api/timesheets/retrieving-time-entries/#retrieve-entries-for-a-specific-date
     */
    public function getByDate($dayOfYear, $year, $user_id = null, $slim = true) {

        $uri = 'daily/' . $dayOfYear . '/' . $year;

        $attributes = [];

        if ($user_id) {
            $attributes[] = 'of_user=' . $user_id;
        }

        if ($slim) {
            $attributes[] = 'slim=1';
        }

        if ($attributes) {
            $uri .= '?' . implode('&', $attributes);
        }

        return $this->connection->makeRequest('get', $uri);
    }


    /**
     * Get a single entry.
     *
     * @param int $id Id of the timesheet.
     * @return mixed
     *
     * @see http://help.getharvest.com/api/timesheets-api/timesheets/retrieving-time-entries/#retrieving-a-single-entry
     */
    public function getById($id)
    {
        $uri = 'daily/show/' . $id;

        return $this->connection->makeRequest('get', $uri);
    }

    /**
     * Create a new entry.
     *
     * @param array $entry Keyed array with all the data needed.
     * @return mixed
     *
     * @see http://help.getharvest.com/api/timesheets-api/timesheets/adding-updating-time/#creating-an-entry
     */
    public function create($entry)
    {
        $uri = 'daily/add';
        return $this->connection->makeRequest('post', $uri, $entry);
    }

    /**
     * Update an existing entry.
     *
     * @param int $id Timesheet entry id.
     * @param array $entry Keyed array with all the changes.
     * @return mixed
     *
     * @see http://help.getharvest.com/api/timesheets-api/timesheets/adding-updating-time/#updating-an-entry
     */
    public function update($id, $entry)
    {
        $uri = 'daily/update/' . $id;
        return $this->connection->makeRequest('put', $uri, $entry);
    }


    /**
     * Delete an existing entry.
     *
     * @param int $id Timesheet entry id.
     * @return mixed
     *
     * @see http://help.getharvest.com/api/timesheets-api/timesheets/adding-updating-time/#deleting-an-entry
     */
    public function delete($id)
    {
        $uri = 'daily/delete/' . $id;
        return $this->connection->makeRequest('delete', $uri);
    }

}