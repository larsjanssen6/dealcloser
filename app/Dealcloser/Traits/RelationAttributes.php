<?php

namespace App\Dealcloser\Traits;

trait RelationAttributes
{
    /**
     * Return full name attribute.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->name.($this->preposition == null ? '' : ' '.$this->preposition).' '.$this->last_name;
    }

    /**
     * Return gender attribute.
     *
     * @return string
     */
    public function getHasGenderAttribute()
    {
        return $this->gender == 0 ? 'Man' : 'Vrouw';
    }

    /**
     * Return problem owner attribute.
     *
     * @return string
     */
    public function getIsProblemOwnerAttribute()
    {
        return $this->problem_owner == 0 ? 'Nee' : 'Ja';
    }

    /**
     * Return married attribute.
     *
     * @return string
     */
    public function getIsMarriedAttribute()
    {
        return $this->married == 0 ? 'Nee' : 'Ja';
    }

    /**
     * Return children attribute.
     *
     * @return string
     */
    public function getHasChildrenAttribute()
    {
        return $this->children == 0 ? 'Nee' : 'Ja';
    }

    /**
     * Return newsletter attribute.
     *
     * @return string
     */
    public function getWantsNewsletterAttribute()
    {
        return $this->newsletter == 0 ? 'Nee' : 'Ja';
    }

    /**
     * Return o3 attribute.
     *
     * @return string
     */
    public function getIso3Attribute()
    {
        return $this->o3 == 0 ? 'Nee' : 'Ja';
    }

    /**
     * Return events attribute.
     *
     * @return string
     */
    public function getWantsEventsAttribute()
    {
        return $this->attributes['events'] == 0 ? 'Nee' : 'Ja';
    }

    /**
     * Return email attribute.
     *
     * @return string
     */
    public function getWantsEmailAttribute()
    {
        return $this->send_email == 0 ? 'Nee' : 'Ja';
    }

    /**
     * Return christmas card attribute.
     *
     * @return string
     */
    public function getWantsChristmasCardAttribute()
    {
        return $this->christmas_card == 0 ? 'Nee' : 'Ja';
    }
}
