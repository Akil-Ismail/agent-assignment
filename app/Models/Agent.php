<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Agent extends Model
{
    /** @use HasFactory<\Database\Factories\AgentFactory> */
    use HasUuids; //has 36 alphanumeric charecters ,can be replaced by Ulid thar has 26 chars.
    use HasFactory;
    protected $table = 'agents';
    protected $primaryKey = 'agent_id';
    public $incrementing = false; //this will turn off auto incrementation
    protected $keyType = 'string';

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }
    public function uniqueIds(): array
    {
        return ['agent_id'];
    }
    public $timestamps = false; //this turns off timestamps automatic setting
    protected $dateFormat = 'U'; //U stands for inix time stamp ,here U calculates the seconds difference since January 1 1970

    const CREATED_AT = 'creation_date_time';
    const UPDATED_AT = 'updated_date_time';

    protected $connection = 'mysql'; //can change the connection directly in the model instead of the inv
    protected $attributes = [
        'title' => 'AI Agent' //assign default value if the input was missing or null.
    ];
}
$agent = Agent::create(['title' => 'Creating my agent']);

Agent::withoutTimestamps(fn() => $agent->increment('counter'));

$agent->id;
