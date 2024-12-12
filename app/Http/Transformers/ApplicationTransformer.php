<?php

namespace App\Http\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Models\Application;

class ApplicationTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'proposer',
        'dean',
        'chairman',
        'president',
        'secretary',
    ];


    public function transform(Application $application): array
    {
        return [
            'id' => $application->id,
            'name' => $application->name,
            'type' => $application->type,
            'organized_by' => $application->organized_by,
            'number_of_seminar_done' => $application->number_of_seminar_done,
            'references' => $application->references,
            'relate_majors' => $application->relate_majors,
            'relate_curriculum' => $application->relate_curriculum,
            'other_info' => $application->other_info,
            'proposed_by' => $application->proposed_by,
            'proposer_signature' => $application->proposer_signature,
            'proposed_at' => Carbon::parse($application->proposed_at)->toIso8601String(),

            'dean_comment' => $application->dean_comment,
            'dean_signature' => $application->dean_signature,
            'dean_commented_by' => $application->dean_commented_by,
            'dean_commented_at' => optional($application->dean_commented_at)->toIso8601String(),

            'chairman_comment' => $application->chairman_comment,
            'chairman_signature' => $application->chairman_signature,
            'chairman_commented_by' => $application->chairman_commented_by,
            'chairman_commented_at' => optional($application->chairman_commented_at)->toIso8601String(),

            'president_comment' => $application->president_comment,
            'president_signature' => $application->president_signature,
            'president_commented_by' => $application->president_commented_by,
            'president_commented_at' => optional($application->president_commented_at)->toIso8601String(),

            'secretary_comment' => $application->secretary_comment,
            'secretary_signature' => $application->secretary_signature,
            'secretary_commented_by' => $application->secretary_commented_by,
            'secretary_commented_at' => optional($application->secretary_commented_at)->toIso8601String(),

            'status' => $application->status,
            'created_at' => Carbon::parse($application->created_at)->toIso8601String(),
            'updated_at' => Carbon::parse($application->updated_at)->toIso8601String(),
        ];
    }

    public function includeProposer(Application $application)
    {
        return $this->item($application->proposedBy, new UserTransformer());
    }

    public function includeDean(Application $application)
    {
        if (!$application->deanCommentedBy) {
            return null;
        }
        return $this->item($application->deanCommentedBy, new UserTransformer());
    }

    public function includeChairman(Application $application)
    {
        if (!$application->chairmanCommentedBy) {
            return null;
        }
        return $this->item($application->chairmanCommentedBy, new UserTransformer());
    }

    public function includePresident(Application $application)
    {
        if (!$application->presidentCommentedBy) {
            return null;
        }
        return $this->item($application->presidentCommentedBy, new UserTransformer());
    }

    public function includeSecretary(Application $application)
    {
        if (!$application->secretaryCommentedBy) {
            return null;
        }
        return $this->item($application->secretaryCommentedBy, new UserTransformer());
    }
}
