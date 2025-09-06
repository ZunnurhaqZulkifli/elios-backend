import { Head } from '@inertiajs/react';
import ModernLayout from '@/Layouts/ModernLayout';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Badge } from '@/Components/ui/badge';
import { 
    Users, 
    Activity, 
    DollarSign, 
    TrendingUp,
    ArrowUpRight,
    ArrowDownRight,
    Plus,
    Calendar,
    Clock
} from 'lucide-react';

export default function Dashboard() {
    return (
        <ModernLayout
            header={
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Dashboard</h1>
                        <p className="text-muted-foreground">
                            Here's what's happening with your application today.
                        </p>
                    </div>
                    <div className="flex space-x-2">
                        <Button variant="outline">
                            <Calendar className="mr-2 h-4 w-4" />
                            This Week
                        </Button>
                        <Button>
                            <Plus className="mr-2 h-4 w-4" />
                            New Project
                        </Button>
                    </div>
                </div>
            }
        >
            <Head title="Dashboard" />
            
            <div className="space-y-6">
                {/* Key Metrics */}
                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Total Revenue</CardTitle>
                            <DollarSign className="h-4 w-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">$45,231.89</div>
                            <div className="flex items-center text-xs text-green-600">
                                <ArrowUpRight className="mr-1 h-3 w-3" />
                                +20.1% from last month
                            </div>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Subscriptions</CardTitle>
                            <Users className="h-4 w-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">+2350</div>
                            <div className="flex items-center text-xs text-green-600">
                                <ArrowUpRight className="mr-1 h-3 w-3" />
                                +180.1% from last month
                            </div>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Sales</CardTitle>
                            <Activity className="h-4 w-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">+12,234</div>
                            <div className="flex items-center text-xs text-green-600">
                                <ArrowUpRight className="mr-1 h-3 w-3" />
                                +19% from last month
                            </div>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Active Now</CardTitle>
                            <TrendingUp className="h-4 w-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">+573</div>
                            <div className="flex items-center text-xs text-red-600">
                                <ArrowDownRight className="mr-1 h-3 w-3" />
                                -2% from last hour
                            </div>
                        </CardContent>
                    </Card>
                </div>

                <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-7">
                    {/* Recent Activity */}
                    <Card className="col-span-4">
                        <CardHeader>
                            <CardTitle>Recent Activity</CardTitle>
                            <CardDescription>
                                Your recent activity and events
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-4">
                                {[
                                    { action: 'New user registered', user: 'John Doe', time: '2 minutes ago', type: 'user' },
                                    { action: 'Payment received', user: 'Jane Smith', time: '10 minutes ago', type: 'payment' },
                                    { action: 'Profile updated', user: 'Bob Johnson', time: '1 hour ago', type: 'update' },
                                    { action: 'New order placed', user: 'Alice Brown', time: '2 hours ago', type: 'order' },
                                    { action: 'Support ticket created', user: 'Charlie Wilson', time: '3 hours ago', type: 'support' },
                                ].map((activity, index) => (
                                    <div key={index} className="flex items-center space-x-4 p-3 rounded-lg border">
                                        <div className="flex items-center justify-center w-8 h-8 rounded-full bg-primary/10">
                                            <Activity className="h-4 w-4" />
                                        </div>
                                        <div className="flex-1 min-w-0">
                                            <p className="text-sm font-medium">{activity.action}</p>
                                            <p className="text-sm text-muted-foreground">{activity.user}</p>
                                        </div>
                                        <div className="flex items-center space-x-2">
                                            <Badge variant="outline" className="text-xs">
                                                {activity.type}
                                            </Badge>
                                            <div className="flex items-center text-xs text-muted-foreground">
                                                <Clock className="mr-1 h-3 w-3" />
                                                {activity.time}
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </CardContent>
                    </Card>

                    {/* Quick Stats */}
                    <Card className="col-span-3">
                        <CardHeader>
                            <CardTitle>Quick Stats</CardTitle>
                            <CardDescription>
                                Overview of your key metrics
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-4">
                                <div className="flex items-center justify-between p-3 border rounded-lg">
                                    <div>
                                        <p className="text-sm font-medium">Active Users</p>
                                        <p className="text-2xl font-bold">1,234</p>
                                    </div>
                                    <Badge variant="default">+12%</Badge>
                                </div>
                                <div className="flex items-center justify-between p-3 border rounded-lg">
                                    <div>
                                        <p className="text-sm font-medium">Total Orders</p>
                                        <p className="text-2xl font-bold">5,678</p>
                                    </div>
                                    <Badge variant="default">+8%</Badge>
                                </div>
                                <div className="flex items-center justify-between p-3 border rounded-lg">
                                    <div>
                                        <p className="text-sm font-medium">Conversion Rate</p>
                                        <p className="text-2xl font-bold">3.2%</p>
                                    </div>
                                    <Badge variant="secondary">-2%</Badge>
                                </div>
                                <div className="flex items-center justify-between p-3 border rounded-lg">
                                    <div>
                                        <p className="text-sm font-medium">Revenue Growth</p>
                                        <p className="text-2xl font-bold">24.5%</p>
                                    </div>
                                    <Badge variant="default">+15%</Badge>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </ModernLayout>
    );
}
