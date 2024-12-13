<?php

namespace App\Actions\Dashboard;

use App\Models\Application;
use App\Models\Subject;
use Illuminate\Http\UploadedFile;

class SaveApplicationAction
{
    protected Application $application;

    public function execute(Application $application, array $data): Application
    {
        $this->application = $application;

        $this->application->name = $data['name'];
        $this->application->type = $data['type'];
        $this->application->number_of_seminar_done = $data['number_of_seminar_done'];
        $this->application->organized_by = $data['organized_by'];
        $this->application->references = $data['references'];
        $this->application->relate_majors = $data['relate_majors'];
        $this->application->relate_curriculum = $data['relate_curriculum'];
        $this->application->other_info = $data['other_info'] ?? null;
        $this->application->proposer_signature = $data['proposer_signature'];
        $this->application->dean_comment = $data['dean_comment'] ?? null;
        $this->application->dean_signature = $data['dean_signature'] ?? null;
        $this->application->chairman_comment = $data['chairman_comment'] ?? null;
        $this->application->chairman_signature = $data['chairman_signature'] ?? null;
        $this->application->president_comment = $data['president_comment'] ?? null;
        $this->application->president_signature = $data['president_signature'] ?? null;
        $this->application->secretary_comment = $data['secretary_comment'] ?? null;
        $this->application->secretary_signature = $data['secretary_signature'] ?? null;
        $this->application->status = $data['next_status'];
        $this->application->save();

//        $this->deleteDocuments(isset($data['to_delete_documents']) ? $data['to_delete_documents'] : []);
//        $this->uploadSubjectDocuments($data['documents']);

        return $this->application;
    }

//    private function deleteDocuments($documents)
//    {
//        foreach ($documents as $document) {
//            $doc = $this->subject->getMedia(Subject::MEDIA_COLLECTION_DOCUMENTS)->where('id', $document['id'])->first();
//            if ($doc) {
//                $doc->delete();
//            }
//        }
//    }

//    private function uploadSubjectDocuments($documents): void
//    {
//        foreach ($documents as $document) {
//            if ($document instanceof UploadedFile) {
//                $this->subject->addMedia($document)->toMediaCollection(Subject::MEDIA_COLLECTION_DOCUMENTS);
//            }
//        }
//    }
}
