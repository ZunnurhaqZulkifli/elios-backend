import { useState } from "react";
import { Head } from "@inertiajs/react";
import MasterLayout from "@/layouts/master-layout";
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { Badge } from "@/components/ui/badge";
import { Input } from "@/components/ui/input";
import { Alert, AlertDescription } from "@/components/ui/alert";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import {
    Plus,
    Search,
    RefreshCw,
    Loader2,
    AlertCircle,
    Trash2,
    Edit,
} from "lucide-react";
import {
    useUsers,
    useUsersSearch,
    useCreateUser,
    useUpdateUser,
    useDeleteUser,
} from "@/hooks/useUsers";

function UsersWithTanStack() {
    const [searchQuery, setSearchQuery] = useState("");
    const [page, setPage] = useState(1);

    // Fetch users with TanStack Query
    const {
        data: usersData,
        isLoading,
        isError,
        error,
        refetch,
        isFetching,
    } = useUsers({ page, per_page: 10 });

    // Search users
    const { data: searchResults, isLoading: isSearching } =
        useUsersSearch(searchQuery);

    // Mutations
    const createUserMutation = useCreateUser();
    const updateUserMutation = useUpdateUser();
    const deleteUserMutation = useDeleteUser();

    const users = searchQuery
        ? searchResults?.data || []
        : usersData?.data || [];
    const totalUsers = usersData?.total || 0;
    const activeUsers = users.filter((user) => user.status === "active").length;
    const adminUsers = users.filter((user) => user.role === "Admin").length;

    const handleCreateUser = async () => {
        try {
            await createUserMutation.mutateAsync({
                name: "New User",
                email: `user${Date.now()}@example.com`,
                role: "User",
                status: "active",
            });
            alert("User created successfully!");
        } catch (error) {
            alert("Error creating user: " + error.message);
        }
    };

    const handleDeleteUser = async (userId) => {
        if (confirm("Are you sure you want to delete this user?")) {
            try {
                await deleteUserMutation.mutateAsync(userId);
                alert("User deleted successfully!");
            } catch (error) {
                alert("Error deleting user: " + error.message);
            }
        }
    };

    const handleToggleUserStatus = async (user) => {
        try {
            await updateUserMutation.mutateAsync({
                id: user.id,
                userData: {
                    ...user,
                    status: user.status === "active" ? "inactive" : "active",
                },
            });
        } catch (error) {
            alert("Error updating user: " + error.message);
        }
    };

    const getRoleBadgeVariant = (role) => {
        switch (role) {
            case "Admin":
                return "destructive";
            case "Manager":
                return "default";
            default:
                return "secondary";
        }
    };

    return (
        <MasterLayout
            header={
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">
                            Users (TanStack Query)
                        </h1>
                        <p className="text-muted-foreground">
                            Example implementation using TanStack Query for API
                            calls
                        </p>
                    </div>
                    <div className="flex gap-2">
                        <Button
                            variant="outline"
                            onClick={() => refetch()}
                            disabled={isFetching}
                        >
                            {isFetching ? (
                                <Loader2 className="mr-2 h-4 w-4 animate-spin" />
                            ) : (
                                <RefreshCw className="mr-2 h-4 w-4" />
                            )}
                            Refresh
                        </Button>
                        <Button
                            onClick={handleCreateUser}
                            disabled={createUserMutation.isPending}
                        >
                            {createUserMutation.isPending ? (
                                <Loader2 className="mr-2 h-4 w-4 animate-spin" />
                            ) : (
                                <Plus className="mr-2 h-4 w-4" />
                            )}
                            Add User
                        </Button>
                    </div>
                </div>
            }
        >
            <Head title="Users - TanStack Query" />

            <div className="space-y-6">
                {/* Error Alert */}
                {isError && (
                    <Alert variant="destructive">
                        <AlertCircle className="h-4 w-4" />
                        <AlertDescription>
                            Error loading users:{" "}
                            {error?.message || "Unknown error"}
                        </AlertDescription>
                    </Alert>
                )}

                {/* Stats Cards */}
                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">
                                Total Users
                            </CardTitle>
                            {isLoading && (
                                <Loader2 className="h-4 w-4 animate-spin" />
                            )}
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">
                                {isLoading ? "-" : totalUsers}
                            </div>
                            <p className="text-xs text-muted-foreground">
                                From TanStack Query API
                            </p>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">
                                Active Users
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">
                                {isLoading ? "-" : activeUsers}
                            </div>
                            <p className="text-xs text-muted-foreground">
                                Currently active
                            </p>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">
                                Admins
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">
                                {isLoading ? "-" : adminUsers}
                            </div>
                            <p className="text-xs text-muted-foreground">
                                Privileged accounts
                            </p>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">
                                API Status
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">
                                <Badge
                                    variant={
                                        isError ? "destructive" : "default"
                                    }
                                >
                                    {isError ? "Error" : "OK"}
                                </Badge>
                            </div>
                            <p className="text-xs text-muted-foreground">
                                TanStack Query
                            </p>
                        </CardContent>
                    </Card>
                </div>

                {/* Search and Users Table */}
                <Card>
                    <CardHeader>
                        <div className="flex items-center justify-between">
                            <div>
                                <CardTitle>Users List</CardTitle>
                                <CardDescription>
                                    Real-time data from API using TanStack Query
                                </CardDescription>
                            </div>
                            <div className="flex items-center space-x-2">
                                <div className="relative">
                                    <Search className="absolute left-2 top-2.5 h-4 w-4 text-muted-foreground" />
                                    <Input
                                        placeholder="Search users..."
                                        className="pl-8 w-64"
                                        value={searchQuery}
                                        onChange={(e) =>
                                            setSearchQuery(e.target.value)
                                        }
                                    />
                                    {isSearching && (
                                        <Loader2 className="absolute right-2 top-2.5 h-4 w-4 animate-spin" />
                                    )}
                                </div>
                            </div>
                        </div>
                    </CardHeader>
                    <CardContent>
                        {isLoading ? (
                            <div className="flex items-center justify-center py-8">
                                <Loader2 className="h-8 w-8 animate-spin" />
                                <span className="ml-2">Loading users...</span>
                            </div>
                        ) : (
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead>User</TableHead>
                                        <TableHead>Role</TableHead>
                                        <TableHead>Status</TableHead>
                                        <TableHead>Actions</TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    {users.length === 0 ? (
                                        <TableRow>
                                            <TableCell
                                                colSpan={4}
                                                className="text-center py-8"
                                            >
                                                {searchQuery
                                                    ? "No users found for your search."
                                                    : "No users available."}
                                            </TableCell>
                                        </TableRow>
                                    ) : (
                                        users.map((user) => (
                                            <TableRow key={user.id}>
                                                <TableCell>
                                                    <div className="flex items-center space-x-3">
                                                        <Avatar className="h-8 w-8">
                                                            <AvatarImage
                                                                src={
                                                                    user.avatar
                                                                }
                                                                alt={user.name}
                                                            />
                                                            <AvatarFallback>
                                                                {user.name
                                                                    ?.charAt(0)
                                                                    ?.toUpperCase()}
                                                            </AvatarFallback>
                                                        </Avatar>
                                                        <div>
                                                            <div className="font-medium">
                                                                {user.name}
                                                            </div>
                                                            <div className="text-sm text-muted-foreground">
                                                                {user.email}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </TableCell>
                                                <TableCell>
                                                    <Badge
                                                        variant={getRoleBadgeVariant(
                                                            user.role
                                                        )}
                                                    >
                                                        {user.role}
                                                    </Badge>
                                                </TableCell>
                                                <TableCell>
                                                    <Button
                                                        variant="ghost"
                                                        size="sm"
                                                        onClick={() =>
                                                            handleToggleUserStatus(
                                                                user
                                                            )
                                                        }
                                                        disabled={
                                                            updateUserMutation.isPending
                                                        }
                                                    >
                                                        <Badge
                                                            variant={
                                                                user.status ===
                                                                "active"
                                                                    ? "default"
                                                                    : "secondary"
                                                            }
                                                        >
                                                            {updateUserMutation.isPending ? (
                                                                <Loader2 className="h-3 w-3 animate-spin mr-1" />
                                                            ) : null}
                                                            {user.status}
                                                        </Badge>
                                                    </Button>
                                                </TableCell>
                                                <TableCell>
                                                    <div className="flex gap-2">
                                                        <Button
                                                            variant="ghost"
                                                            size="sm"
                                                        >
                                                            <Edit className="h-4 w-4" />
                                                        </Button>
                                                        <Button
                                                            variant="ghost"
                                                            size="sm"
                                                            onClick={() =>
                                                                handleDeleteUser(
                                                                    user.id
                                                                )
                                                            }
                                                            disabled={
                                                                deleteUserMutation.isPending
                                                            }
                                                        >
                                                            {deleteUserMutation.isPending ? (
                                                                <Loader2 className="h-4 w-4 animate-spin" />
                                                            ) : (
                                                                <Trash2 className="h-4 w-4" />
                                                            )}
                                                        </Button>
                                                    </div>
                                                </TableCell>
                                            </TableRow>
                                        ))
                                    )}
                                </TableBody>
                            </Table>
                        )}
                    </CardContent>
                </Card>
            </div>
        </MasterLayout>
    );
}

export default UsersWithTanStack;
