select quotes_request.*,users.first_name as client_name,quotes.rid as rid,quotes.cost as cost,
            quotes.message as message, quotes.down_payment as dp,b.ma as max_cost,b.mi as min_cost,b.cost_avg as avg_cost,
            company_category.company_id, company_category.category_id,b.crid
            from quotes_request 
            inner join company_category on company_category.category_id = quotes_request.category_id 
            inner join companies on companies.id = company_category.company_id and companies.state = quotes_request.state 
            and (companies.vicinity_id = quotes_request.vicinity_id or quotes_request.vicinity_id = 0 )
            inner join users on users.id = quotes_request.client_id  
            left join quotes on quotes.rid=quotes_request.id and quotes.uid = companies.id
            left join (select rid,max(q1.cost) as ma,min(q1.cost) as mi,avg(cost) as cost_avg,count(rid) as crid from quotes q1 group by q1.rid) b on b.rid = quotes.rid
            left join dismiss on dismiss.rid = quotes_request.id and dismiss.uid = companies.id where companies.id = 295 and  dismiss.rid is null and timestampdiff(DAY,companies.created_at,quotes_request.created_at) > 0 group by quotes_request.id,quotes_request.category_id order by quotes_request.id desc