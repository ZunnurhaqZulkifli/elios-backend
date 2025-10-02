import { Button } from "@/components/ui/button";
import MasterLayout from "@/layouts/master-layout";
import { Head } from "@inertiajs/react";
import { Plus } from "lucide-react";

function Create(props) {
    return (
        <MasterLayout
            header={
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">
                            Tasks
                        </h1>
                        <p className="text-muted-foreground">
                            Create a new task
                        </p>
                    </div>
                </div>
            }
        >
            <Head title="Tasks" />
        </MasterLayout>
    );
}

export default Create;
