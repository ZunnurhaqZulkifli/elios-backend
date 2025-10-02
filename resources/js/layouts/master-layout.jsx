import { Link, usePage } from "@inertiajs/react";
import { useApiToken } from "@/hooks/useApiToken";

import { Bell, LogOut, Moon, Search, Sun, User } from "lucide-react";

import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { Input } from "@/components/ui/input";
import { Separator } from "@/components/ui/separator";
import { useTheme } from "@/contexts/theme-context";

import MobileSidebar from "./sidebar/mobile";
import SidebarContent from "./sidebar/content";

export default function MasterLayout({ header, children }) {
    const user = usePage().props.auth.user;
    const { theme, toggleTheme } = useTheme();

    // Initialize API token for Sanctum authentication
    useApiToken();

    return (
        <div className="min-h-screen bg-background">
            {/* Mobile sidebar */}
            <MobileSidebar />

            {/* Desktop sidebar */}
            <div className="hidden md:fixed md:inset-y-0 md:z-50 md:flex md:w-64 md:flex-col">
                <Card className="flex-1 border-r-0 rounded-none">
                    <CardContent className="p-0 h-full">
                        <SidebarContent />
                    </CardContent>
                </Card>
            </div>

            {/* Main content */}
            <div className="md:pl-64">
                {/* Top header */}
                <header className="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60 px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                    {/* Search */}
                    <div className="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                        <div className="relative flex flex-1 items-center">
                            <Search className="pointer-events-none absolute left-3 h-4 w-4 text-muted-foreground" />
                            <Input
                                placeholder="Search..."
                                className="pl-9 w-full max-w-md"
                            />
                        </div>
                    </div>

                    {/* Right side */}
                    <div className="flex items-center gap-x-4 lg:gap-x-6">
                        {/* Notifications */}
                        <Button variant="ghost" size="sm" className="relative">
                            <Bell className="h-5 w-5" />
                            <Badge
                                variant="destructive"
                                className="absolute -top-1 -right-1 h-5 w-5 rounded-full p-1"
                            >
                                3
                            </Badge>
                        </Button>

                        {/* Theme toggle */}
                        <Button
                            variant="ghost"
                            size="sm"
                            onClick={toggleTheme}
                            className="relative"
                        >
                            {theme === "light" ? (
                                <Moon className="h-5 w-5" />
                            ) : (
                                <Sun className="h-5 w-5" color="yellow" />
                            )}
                        </Button>

                        <Separator orientation="vertical" className="h-6" />

                        {/* Profile dropdown */}
                        <DropdownMenu>
                            <DropdownMenuTrigger asChild>
                                <Button
                                    variant="ghost"
                                    className="relative h-8 w-8 rounded-full"
                                >
                                    <Avatar className="h-8 w-8">
                                        <AvatarFallback>
                                            {user.name
                                                ?.charAt(0)
                                                ?.toUpperCase() || "U"}
                                        </AvatarFallback>
                                    </Avatar>
                                </Button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent
                                className="w-56"
                                align="end"
                                forceMount
                            >
                                <DropdownMenuLabel className="font-normal">
                                    <div className="flex flex-col space-y-1">
                                        <p className="text-sm font-medium leading-none">
                                            {user.name}
                                        </p>
                                        <p className="text-xs leading-none text-muted-foreground">
                                            {user.email}
                                        </p>
                                    </div>
                                </DropdownMenuLabel>
                                <DropdownMenuSeparator />
                                <DropdownMenuItem asChild>
                                    <Link
                                        href={route("profile.edit")}
                                        className="cursor-pointer"
                                    >
                                        <User className="mr-2 h-4 w-4" />
                                        <span>Profile</span>
                                    </Link>
                                </DropdownMenuItem>
                                <DropdownMenuSeparator />
                                <DropdownMenuItem asChild>
                                    <Link
                                        href={route("logout")}
                                        method="post"
                                        as="button"
                                        className="cursor-pointer w-full"
                                    >
                                        <LogOut className="mr-2 h-4 w-4" />
                                        <span>Log out</span>
                                    </Link>
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>
                </header>

                {/* Page header */}
                {header && (
                    <div className="bg-background px-4 py-6 sm:px-6 lg:px-8">
                        <div className="border-b pb-4">{header}</div>
                    </div>
                )}

                {/* Main content */}
                <main className="px-4 py-6 sm:px-6 lg:px-8">{children}</main>
            </div>
        </div>
    );
}
