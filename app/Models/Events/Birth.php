<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 21.12.2019
 * Time: 12:21
 */

namespace App\Models\Events;

use App\Models\Body;
use App\Models\BodyFace;
use App\Models\Character;
use App\Models\Event;
use App\Models\LastName;
use App\Models\Mind;
use App\Models\MindSpin;
use App\Models\Name;
use App\Models\Sex;

class Birth extends Event {

    /**
     * @var Character
     */
    private $child;

    protected function executeEvent() {

        /* PARENTS */
        $mother = $this->participants[0];
        $father = $this->participants[1];

        $sex = (isset($this->conditions['sex'])) ? $this->conditions['sex'] : Sex::random()->slug;

        $child = new Character();

        $params = array(
            'sex' => $sex,
        );
        $child->name = (isset($this->conditions['name'])) ? $this->conditions['name'] : Name::random($params)->name;
        $child->last_name = (isset($this->conditions['last_name'])) ? $this->conditions['last_name'] : LastName::random($params)->name;

        $child->save();

        /* BODY */
        $body = new Body();

        $body->age = 0;
        $body->sex = $sex;

        $motherFace = $mother->body->face->toArray();
        $fatherFace = $father->body->face->toArray();
        $face = BodyFace::getAverage($motherFace, $fatherFace);
        $body->setFace($face);

        $child->body()->save($body);
        /* BODY */

        /* MIND */
        $mind = new Mind();

        $motherSpin = $mother->mind->spin->toArray();
        $fatherSpin = $father->mind->spin->toArray();
        $spin = MindSpin::getAverage($motherSpin, $fatherSpin);
        $mind->setSpin($spin);

        $child->mind()->save($mind);
        /* MIND */

        $this->child = $child;

    }

    protected function getConsequences() {
        return $this->child;
    }

    protected function getDepiction() {
        // TODO: Implement getDepiction() method.
    }

}
