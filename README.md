# loan

## Initial loan schedule calculation
  * Payment dates calculation
    * Specific day (date) of month
      * Should date be adjusted in case of weekend?
        * To previous working day?
        * To following working day?
    * Other
      * Last working day of month
      * First working day of month
      * ...
  * Full payment amount calculation (based on payment dates)
    * Equal payment (annuity)
    * Exact payment (annuity into day level)

## Interest calculation precision
  * Monthly (yearly interest rate is divided by 12 - number of exact days does not matter)
  * Daily (yearly interest rate is divided by 360 - number of exact days is taken into account)
  
## Adjusting in case or overdue, early repayment
  * Early repayment - should interest be adjusted in case of early repayment (current payment period is shortened)
    * Only current payment - period shortens
    * Only following payment - period extends
    * Both payments
  * Late repayment - should interest be adjusted in case of late repayment (current payment period is extended)
    * Only current payment
    * Only following payment
    * Both payments