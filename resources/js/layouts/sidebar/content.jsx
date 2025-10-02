import { Link, usePage } from "@inertiajs/react";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import ApplicationLogo from "@/components/ApplicationLogo";
import SidebarNavigation from "./navigation";
import navigationMenus from "./sidebar-menus";

export default function SidebarContent() {
    const user = usePage().props.auth.user;
    return (
        <div className="flex h-full flex-col">
            {/* Logo */}
            <div className="flex h-16 shrink-0 items-center px-4">
                <Link href="/" className="flex items-center space-x-2">
                    <ApplicationLogo className="h-8 w-8" />
                    <span className="text-xl font-bold">Elios</span>
                </Link>
            </div>

            {/* Navigation */}
            <SidebarNavigation navigationMenus={navigationMenus} />

            {/* User info at bottom */}
            <div className="border-t p-4">
                <div className="flex items-center space-x-3">
                    <Avatar className="h-8 w-8">
                        <AvatarImage src={user.avatar} alt={user.name} />
                        <AvatarFallback>
                            {user.name?.charAt(0)?.toUpperCase() || "U"}
                        </AvatarFallback>
                    </Avatar>
                    <div className="flex-1 min-w-0">
                        <p className="text-sm font-medium truncate">
                            {user.name}
                        </p>
                        <p className="text-xs text-muted-foreground truncate">
                            {user.email}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    );
}
